<?php
include '../config.php';
$admin = new Admin();

if (isset($_SESSION['a_id'])) {
    $aid = $_SESSION['a_id'];
    $getAdmin = $admin->ret("SELECT * FROM `admin` where `a_id`='$aid'");
    $adminProfile = $getAdmin->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location:./index.php");
}

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Bus Booking | Admin</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include "./includes/sidebar.php"; ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                                height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <?php include "./includes/navbar.php"; ?>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                            <!-- <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6> -->
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <?php
                                                $getCustomers = $admin->ret("SELECT * FROM `customer`");
                                                $customers = $getCustomers->rowCount();
                                                ?>
                                                <p class="card-category">Customers</p>
                                                <h4 class="card-title"><?php echo $customers; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <?php
                                                $getBuses = $admin->ret("SELECT * FROM `bus` where `b_status`='Available' ");
                                                $buses = $getBuses->rowCount();
                                                ?>
                                                <p class="card-category">Buses Available</p>
                                                <h4 class="card-title"><?php echo $buses; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fas fa-luggage-cart"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <?php
                                                $getTrips = $admin->ret("SELECT * FROM `trip` where `t_status`='Scheduled' ");
                                                $trips = $getTrips->rowCount();
                                                ?>
                                                <p class="card-category">Trips Scheduled</p>
                                                <h4 class="card-title"><?php echo $trips; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <?php
                                                $getBookings = $admin->ret("SELECT * FROM `bookings` where `bk_status`='Booked'");
                                                $bookings = $getBookings->rowCount();
                                                ?>
                                                <p class="card-category">Trip Booked</p>
                                                <h4 class="card-title"><?php echo $bookings; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-round">
                                <div class="card-body">
                                    <div class="card-head-row card-tools-still-right">
                                        <div class="card-title">New Customers</div>
                                    </div>
                                    <div class="card-list py-4">
                                        <?php
                                        $getCustomers = $admin->ret("SELECT * FROM `customer` order by c_id desc LIMIT 5");
                                        while ($customers = $getCustomers->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <div class="item-list">
                                                <div class="avatar">
                                                    <img src="assets/img/profile.png" alt="..."
                                                        class="avatar-img rounded-circle" />
                                                </div>
                                                <div class="info-user ms-3">
                                                    <div class="username"><?php echo $customers['c_username']; ?></div>
                                                    <div class="status"><?php echo $customers['c_email']; ?></div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-round">
                                <div class="card-header">
                                    <div class="card-head-row card-tools-still-right">
                                        <div class="card-title">Transaction History</div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <!-- Projects table -->
                                        <table class="table align-items-center mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Payment Number</th>
                                                    <th scope="col" class="text-end">Date & Time</th>
                                                    <th scope="col" class="text-end">Amount</th>
                                                    <th scope="col" class="text-end">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $getBookings = $admin->ret("SELECT * FROM `bookings` inner join `customer` on customer.c_id=bookings.c_id order by bk_id desc LIMIT 5");
                                                $number = $getBookings->rowCount();
                                                if ($number > 0) {
                                                    while ($booking = $getBookings->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                        <tr>
                                                            <th scope="row">
                                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                                    <i class="fa fa-check"></i>
                                                                </button>
                                                                Payment from <?php echo $booking['bk_name']; ?>
                                                            </th>
                                                            <td class="text-end"><?php echo $booking['bk_date']; ?></td>
                                                            <td class="text-end">₹<?php echo $booking['bk_total_fair']; ?></td>
                                                            <td class="text-end">
                                                                <span
                                                                    class="badge badge-success"><?php echo $booking['bk_status']; ?></span>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <th colspan="4" class="text-center text-danger">
                                                            No transaction found!
                                                        </th>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "./includes/footer.php"; ?>
        </div>


        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <!-- <script src="assets/js/setting-demo.js"></script> -->
    <script src="assets/js/demo.js"></script>
    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
</body>

</html>