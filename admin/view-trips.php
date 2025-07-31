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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Bus Booking | Admin</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="./assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="./assets/js/plugin/webfont/webfont.min.js"></script>
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
            urls: ["./assets/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/plugins.min.css" />
    <link rel="stylesheet" href="./assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="./assets/css/demo.css" />
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
                        <a href="../index.html" class="logo">
                            <img src="./assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
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
                    <div class="page-header ">
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a>Trips</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Trips</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#addRowModal">
                                            <i class="fa fa-plus"></i>
                                            Schedule New Trip
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold"> Schedule </span>
                                                        <span class="fw-light"> New Trip</span>
                                                    </h5>
                                                    <button data-bs-dismiss="modal" type="button" class="btn  btn-close"
                                                        data-dismiss="addRowModal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="small">
                                                        Schedule new trip by filling below form. Fill all the fields
                                                    </p>
                                                    <form method="post" action="./Controllers/Trip.php">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>From Location</label>
                                                                    <input required name="from" type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter from location here" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Destination</label>
                                                                    <input required name="to" type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter destination here" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Select Bus</label>
                                                                    <select class="form-control" name="bus" required>
                                                                        <option hidden value="">Select Bus</option>
                                                                        <?php
                                                                        $getBuses = $admin->ret("SELECT * FROM `bus` where `b_status`='Available'");
                                                                        while ($bus = $getBuses->fetch(PDO::FETCH_ASSOC)) {
                                                                            ?>
                                                                        <option value="<?php echo $bus['b_id']; ?>">
                                                                            <?php echo $bus['b_name']; ?> |
                                                                            <?php echo $bus['b_number']; ?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Root (Via)</label>
                                                                    <input required name="root" type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter root here" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Trip Date</label>
                                                                    <input required name="date" type="datetime-local"
                                                                        min="<?php echo date('Y-m-d\TH:i'); ?>"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Trip duration (in hrs)</label>
                                                                    <input required name="duration" type="number"
                                                                        class="form-control"
                                                                        placeholder="Enter trip duration here" value="9"
                                                                        min="1" max="100" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Ticket Fair</label>
                                                                    <input required name="ticket" type="number"
                                                                        value="500" min="10" class="form-control"
                                                                        placeholder="Enter ticket fair here" />
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button name="insertTrip" type="submit"
                                                                class="btn btn-primary">
                                                                Insert
                                                            </button>
                                                            <button type="button" data-bs-dismiss="modal"
                                                                class="btn btn-danger" data-dismiss="modal">
                                                                Close
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>From & To Location</th>
                                                    <th>Bus & Driver</th>
                                                    <th>Ticket Fair</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>From & To Location</th>
                                                    <th>Bus & Driver</th>
                                                    <th>Ticket Fair</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['t_id'])) {
                                                    $tid=$_GET['t_id'];
                                                    $getTrips = $admin->ret("SELECT * FROM `trip` INNER JOIN `bus` ON bus.b_id = trip.b_id where `t_id`='$tid'");
                                                }else{
                                                    $getTrips = $admin->ret("SELECT * FROM `trip` INNER JOIN `bus` ON bus.b_id = trip.b_id");
                                                }
                                                while ($trip = $getTrips->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                            echo $trip['t_from'] . ' | ' . date('Y-m-d H:i', strtotime($trip['t_date']));
                                                            echo '<br /> via ' .$trip['t_root'];
                                                            echo '<br />' . $trip['t_to'];

                                                            $startDateTime = strtotime($trip['t_date']);
                                                            $tripDuration = $trip['t_duration'];
                                                            $durationInSeconds = $tripDuration * 3600;
                                                            $arrivalTime = $startDateTime + $durationInSeconds;
                                                            echo ' | ' . date('Y-m-d H:i', $arrivalTime);
                                                            echo '<br />' . $trip['t_duration'] . ' hrs';
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $trip['b_name']; ?> |
                                                        <?php echo $trip['b_number']; ?><br />
                                                        <?php echo $trip['b_driver_name']; ?> |
                                                        <?php echo $trip['b_driver_phone']; ?>
                                                    </td>
                                                    <td>₹<?php echo $trip['t_ticket']; ?></td>
                                                    <td><?php echo $trip['t_status']; ?></td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <button type="button"
                                                                class="btn btn-link btn-primary btn-lg"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editModal<?php echo $trip['t_id']; ?>">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <a type="button" title="view seats availability"
                                                                class="btn btn-link w-100 mt-1"
                                                                href="./view-seats.php?b_id=<?php echo $trip['b_id']; ?>">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modal for Editing -->
                                                <div class="modal fade" id="editModal<?php echo $trip['t_id']; ?>"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title">Edit Trip Details</h5>
                                                                <button type="button" class="btn btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="./Controllers/Trip.php">
                                                                    <input type="hidden" name="tripId"
                                                                        value="<?php echo $trip['t_id']; ?>" />
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group form-group-default">
                                                                                <label>From Location</label>
                                                                                <input required name="from" type="text"
                                                                                    class="form-control"
                                                                                    value="<?php echo $trip['t_from']; ?>" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Destination</label>
                                                                                <input required name="to" type="text"
                                                                                    class="form-control"
                                                                                    value="<?php echo $trip['t_to']; ?>" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Root (via)</label>
                                                                                <input required name="root" type="text"
                                                                                    class="form-control"
                                                                                    value="<?php echo $trip['t_root']; ?>" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Trip Date</label>
                                                                                <input required name="date"
                                                                                    type="datetime-local"
                                                                                    min="<?php echo date('Y-m-d\TH:i'); ?>"
                                                                                    class="form-control"
                                                                                    value="<?php echo date('Y-m-d\TH:i', strtotime($trip['t_date'])); ?>" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Trip Duration (in hrs)</label>
                                                                                <input required name="duration"
                                                                                    type="number" class="form-control"
                                                                                    value="<?php echo $trip['t_duration']; ?>"
                                                                                    min="1" max="100" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Ticket Fare</label>
                                                                                <input required name="ticket"
                                                                                    type="number" class="form-control"
                                                                                    value="<?php echo $trip['t_ticket']; ?>"
                                                                                    min="10" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Select Bus</label>
                                                                                <select class="form-control" name="bus"
                                                                                    required>
                                                                                    <option hidden
                                                                                        value="<?php echo $trip['b_id']; ?>">
                                                                                        <?php echo $trip['b_name']; ?>
                                                                                    </option>
                                                                                    <?php
                                                                                        $getBuses = $admin->ret("SELECT * FROM `bus` where `b_status`='Available'");
                                                                                        while ($bus = $getBuses->fetch(PDO::FETCH_ASSOC)) {
                                                                                            ?>
                                                                                    <option
                                                                                        value="<?php echo $bus['b_id']; ?>">
                                                                                        <?php echo $bus['b_name']; ?> |
                                                                                        <?php echo $bus['b_number']; ?>
                                                                                    </option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Trip Status</label>
                                                                                <select class="form-control"
                                                                                    name="status" required>
                                                                                    <option value="Scheduled"
                                                                                        <?php echo ($trip['b_status'] == 'Scheduled') ? 'selected' : ''; ?>>
                                                                                        Scheduled</option>
                                                                                    <option value="Completed"
                                                                                        <?php echo ($trip['b_status'] == 'Completed') ? 'selected' : ''; ?>>
                                                                                        Completed</option>
                                                                                    <option value="Cancelled"
                                                                                        <?php echo ($trip['b_status'] == 'Cancelled') ? 'selected' : ''; ?>>
                                                                                        Cancelled</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button name="updateTrip" type="submit"
                                                                            class="btn btn-primary">Update</button>
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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
    <script src="./assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="./assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="./assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="./assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="./assets/js/setting-demo2.js"></script>
    <script>
    $(document).ready(function() {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
            pageLength: 5,
            initComplete: function() {
                this.api()
                    .columns()
                    .every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on("change", function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column
                                    .search(val ? "^" + val + "$" : "", true, false)
                                    .draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                select.append(
                                    '<option value="' + d + '">' + d + "</option>"
                                );
                            });
                    });
            },
        });

        // Add Row
        $("#add-row").DataTable({
            pageLength: 5,
        });

        var action =
            '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#closeModal").click(function() {
            $("#addRowModal").modal("hide");
        });
        $("#closeModal1").click(function() {
            $("#addRowModal").modal("hide");
        });

    });
    </script>
</body>

</html>