<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['signup'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $profile = "uploads/" . basename($_FILES['profile']['name']);
    // move_uploaded_file($_FILES['profile']['tmp_name'], $profile);
    $check = $admin->ret("SELECT * FROM `customer` WHERE `c_email`='$email'");
    $number = $check->rowCount();
    if ($number > 0) {
        echo "<script>alert('Email already exists! try with different email ID');window.location='../register.php';</script>";
    } else {
        $stmt = $admin->cud("INSERT INTO `customer`(`c_username`, `c_email`, `c_password`, `c_added_date`, `c_status`) VALUES ('$name','$email','$password',now(),'Active')", "saved");
        echo "<script>alert('Registration successful! continue to login');window.location='../login.php';</script>";
    }
}


if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $st = $admin->ret("SELECT * FROM `customer` WHERE `c_email`='$email' AND `c_password`='$password'");
    $number = $st->rowCount();
    if ($number > 0) {
        $customer = $st->fetch(PDO::FETCH_ASSOC);
        $customerId = $customer['c_id'];
        $_SESSION['c_id'] = $customerId;
        echo "<script>alert('Login successful!');window.location='../index.php';</script>";
    } else {
        echo "<script>alert('Login failed!');window.location='../login.php';</script>";
    }

}

if (isset($_GET['condition'])) {
    $condition = $_GET['condition'];
    if (isset($_SESSION['c_id'])) {
        session_destroy();
        unset($_SESSION['c_id']);
        header('Location:../index.php');
    }
}
?>