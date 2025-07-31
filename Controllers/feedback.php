<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['submitFeedback'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt = $admin->cud("INSERT INTO `contact`(`cn_date`,`cn_name`, `cn_phone`, `cn_email`, `cn_subject`, `cn_message`) VALUES (now(),'$name','$phone','$email','$subject','$message')", "saved");
    echo "<script>alert('Thank you for your feedback!');window.location='../contact.php';</script>";

}

?>