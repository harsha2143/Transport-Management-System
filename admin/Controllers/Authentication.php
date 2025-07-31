<?php
include '../../config.php';
$admin = new Admin();

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $st = $admin->ret("SELECT * FROM `admin` WHERE `a_email`='$email' AND `a_password`='$password'");
    $number = $st->rowCount();
    if ($number > 0) {
        $adminProfile = $st->fetch(PDO::FETCH_ASSOC);
        $adminId = $adminProfile['a_id'];
        $_SESSION['a_id'] = $adminId;
        echo "<script>alert('Login successful!');window.location='../dashboard.php';</script>";
    } else {
        echo "<script>alert('Login failed!');window.location='../index.php';</script>";
    }

}

if (isset($_GET['condition'])) {
    $condition = $_GET['condition'];
    if (isset($_SESSION['a_id'])) {
        session_destroy();
        unset($_SESSION['a_id']);
        header('Location:../index.php');
    }
}
?>