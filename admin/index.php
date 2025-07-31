<?php
include '../config.php';
$admin = new Admin();
$today = date('Y-m-d'); // Current date for the booking
$getTrips = $admin->ret("SELECT * FROM `trip` WHERE DATE(`t_date`) = STR_TO_DATE('$today', '%Y-%m-%d')");
while ($trip = $getTrips->fetch(PDO::FETCH_ASSOC)) {
    $updateTrips = $admin->cud("UPDATE `trip` SET `t_status`='Completed' WHERE DATE(`t_date`) = STR_TO_DATE('$today', '%Y-%m-%d')", "message");
    $tripId = $trip['t_id'];
    $getBookings = $admin->ret("SELECT * FROM `bookings` where `t_id`='$tripId'");
    while ($booking = $getBookings->fetch(PDO::FETCH_ASSOC)) {
        $bookingId = $booking['bk_id'];
        $getPassengers = $admin->ret("SELECT * FROM `passenger` where `bk_id`='$bookingId'");
        while ($passengers = $getPassengers->fetch(PDO::FETCH_ASSOC)) {
            $seatId = $passengers['s_id'];
            $updateSeats = $admin->cud("UPDATE `seats` SET `s_booked_for`='', `s_status`='Available' WHERE `s_id`='$seatId'", "message");
            $updatePassenger = $admin->cud("UPDATE `passenger` SET `ps_status`='Completed' WHERE `s_id`='$seatId'", "message");

        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bus Booking | Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Login/css/util.css">
    <link rel="stylesheet" type="text/css" href="../Login/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('../Login/images/bg-01.jpg');">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
                <form class="login100-form validate-form flex-sb flex-w" method="post"
                    action="./Controllers/Authentication.php">
                    <span class="login100-form-title p-b-53">
                        Admin Sign In
                    </span>

                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Email ID
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Email ID is required">
                        <input class="input100" type="email" name="email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="p-t-13 p-b-9">
                        <span class="txt1">
                            Password
                        </span>

                        <!-- <a href="#" class="txt2 bo1 m-l-5">
                            Forgot?
                        </a> -->
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-17 mb-5">
                        <button name="signIn" type="submit" class="login100-form-btn">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="../Login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="../Login/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="../Login/vendor/bootstrap/js/popper.js"></script>
    <script src="../Login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="../Login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="../Login/vendor/daterangepicker/moment.min.js"></script>
    <script src="../Login/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="../Login/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="../Login/js/main.js"></script>

</body>

</html>