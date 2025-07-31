<?php
include '../../config.php';
$admin = new Admin();
if (isset($_POST['insertTrip'])) {
    $from = $_POST['from'];
    $root = $_POST['root'];
    $to = $_POST['to'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $ticket = $_POST['ticket'];
    $bus = $_POST['bus'];
    $status = "Scheduled";
    $check = $admin->ret("SELECT * FROM `trip` WHERE `t_date`='$date' AND `b_id`='$bus'");
    $number = $check->rowCount();
    if ($number > 0) {
        echo "<script>alert('Bus already scheduled for different trip ! select different bus.');window.location='../view-trips.php';</script>";
    } else {
        $insertTrip = $admin->cud("INSERT INTO `trip`(`t_date`, `b_id`, `t_from`, `t_to`,`t_root`, `t_duration`, `t_ticket`, `t_added_date`, `t_status`)
         VALUES ('$date','$bus','$from','$to','$root','$duration','$ticket',now(),'$status')", "message");
        echo "<script>alert('Trip scheduled successfully!');window.location='../view-trips.php';</script>";
    }
}
if (isset($_POST['updateTrip'])) {
    $tripId = $_POST['tripId']; // Assuming you're passing the trip ID for the update
    $from = $_POST['from'];
    $root = $_POST['root'];
    $to = $_POST['to'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $ticket = $_POST['ticket'];
    $bus = $_POST['bus'];
    $status = $_POST['status']; // Assuming you're allowing status to be updated

    // Check for existing trip with the same bus and date, but exclude the current trip being updated
    $check = $admin->ret("SELECT * FROM `trip` WHERE `t_date`='$date' AND `b_id`='$bus' AND `t_id` != '$tripId'");
    $number = $check->rowCount();

    if ($number > 0) {
        echo "<script>alert('Bus already scheduled for a different trip! Select a different bus.');window.location='../view-trips.php';</script>";
    } else {
        $updateTrip = $admin->cud("UPDATE `trip` SET `t_date`='$date', `b_id`='$bus', `t_from`='$from', `t_to`='$to',`t_root`='$root',
         `t_duration`='$duration', `t_ticket`='$ticket', `t_status`='$status' WHERE `t_id`='$tripId'", "message");
        echo "<script>alert('Trip updated successfully!');window.location='../view-trips.php';</script>";
    }
}
?>