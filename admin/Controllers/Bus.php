<?php
include '../../config.php';
$admin = new Admin();
if (isset($_POST['insertBus'])) {
    $bName = $_POST['bName'];
    $dName = $_POST['dName'];
    $dPhone = $_POST['dPhone'];
    $bNumber = $_POST['bNumber'];
    $seats = $_POST['seats'];
    $type = $_POST['type'];
    $check = $admin->ret("SELECT * FROM `bus` WHERE `b_number`='$bNumber'");
    $number = $check->rowCount();
    if ($number > 0) {
        echo "<script>alert('Bus already exists !');window.location='../view-buses.php';</script>";
    } else {
        $insertBus = $admin->Rcud("INSERT INTO `bus`(`b_name`, `b_driver_name`, `b_driver_phone`, `b_number`, `b_total_seats`, `b_type`, `b_added_date`, `b_status`) 
        VALUES ('$bName','$dName','$dPhone','$bNumber','$seats','$type',now(),'Available')");
        // $insertSeats = $admin->cud("", "message");
        // echo "<script>alert('Bus information inserted successfully !');window.location='../view-buses.php';</script>";
        $lowerSeats = floor($seats / 2);
        $upperSeats = $seats - $lowerSeats; // In case of odd number, upper gets the extra seat

        // Insert lower berth seats (L1 to Lx)
        for ($i = 1; $i <= $lowerSeats; $i++) {
            $seatName = 'L' . $i;
            $admin->cud("INSERT INTO `seats`(`b_id`, `s_number`, `s_booked_for`, `s_added_date`, `s_status`) 
                VALUES ('$insertBus', '$seatName', '', now(), 'Available')", "message");
        }

        // Insert upper berth seats (U1 to Ux)
        for ($i = 1; $i <= $upperSeats; $i++) {
            $seatName = 'U' . $i;
            $admin->cud("INSERT INTO `seats`(`b_id`, `s_number`, `s_booked_for`, `s_added_date`, `s_status`) 
                VALUES ('$insertBus', '$seatName', '', now(), 'Available')", "message");
        }

        echo "<script>alert('Bus and seats information inserted successfully!');window.location='../view-buses.php';</script>";
    }
}
if (isset($_POST['updateBus'])) {
    $busId = $_POST['busId'];
    $bName = $_POST['bName'];
    $dName = $_POST['dName'];
    $dPhone = $_POST['dPhone'];
    $bNumber = $_POST['bNumber'];
    // $seats = $_POST['seats'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $check = $admin->cud("UPDATE `bus` SET `b_name`='$bName',`b_driver_name`='$dName',`b_driver_phone`='$dPhone',`b_number`='$bNumber',`b_type`='$type',`b_status`='$status' WHERE `b_id`='$busId'", "message");
    echo "<script>alert('Bus information updated successfully!');window.location='../view-buses.php';</script>";

}
?>