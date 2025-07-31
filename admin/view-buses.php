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
                                <a>Buses</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Buses</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#addRowModal">
                                            <i class="fa fa-plus"></i>
                                            Add New Bus
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
                                                        <span class="fw-mediumbold"> Add </span>
                                                        <span class="fw-light"> New Bus</span>
                                                    </h5>
                                                    <button data-bs-dismiss="modal" type="button" class="btn  btn-close"
                                                        data-dismiss="addRowModal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="small">
                                                        Add new bus by filling below form. Fill all the fields
                                                    </p>
                                                    <form method="post" action="./Controllers/Bus.php">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Name</label>
                                                                    <input required name="bName" type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter bus name here" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 pe-0">
                                                                <div class="form-group form-group-default">
                                                                    <label>Driver name</label>
                                                                    <input required name="dName" type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter driver name here" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Driver Contact Number</label>
                                                                    <input required name="dPhone" type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter Driver Contact Number"
                                                                        pattern="^[6-9]\d{9}$"
                                                                        title="Must be exactly 10 digits starting with 6, 7, 8, or 9." />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Bus Number</label>
                                                                    <input required name="bNumber" type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter Bus Number here"
                                                                        pattern="^[A-Z]{2}\s\d{1,2}\s[A-Z]{1,2}\s\d{4}$"
                                                                        title="Format: 'XX 00 XX 0000' (e.g., MH 12 AB 1234)" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Available Seats</label>
                                                                    <input required name="seats" type="number"
                                                                        value="34" min="20" max="50"
                                                                        class="form-control"
                                                                        placeholder="Enter Available Seats here" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Bus Type</label>
                                                                    <select class="form-control" name="type" required>
                                                                        <option hidden value="">Select Bus Type</option>
                                                                        <option value="AC Sleeper">Ac Sleeper</option>
                                                                        <option value="AC Seater">Ac Seater</option>
                                                                        <option value="VE A/C Sleeper">VE A/C Sleeper
                                                                        </option>
                                                                        <option value="NON A/C Seater">NON A/C Seater
                                                                        </option>
                                                                        <option value="NON A/C Sleeper">NON A/C Sleeper
                                                                        </option>
                                                                        <option value="VE Executive A/C Sleeper">VE
                                                                            Executive A/C Sleeper
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button name="insertBus" type="submit"
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
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Driver</th>
                                                    <th>Seats</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Driver</th>
                                                    <th>Seats</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
            $getBuses = $admin->ret("SELECT * FROM `bus`");
            while ($bus = $getBuses->fetch(PDO::FETCH_ASSOC)) {
                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $bus['b_name']; ?> <br />
                                                        <?php echo $bus['b_number']; ?>
                                                    </td>
                                                    <td><?php echo $bus['b_type']; ?></td>
                                                    <td>
                                                        <?php echo $bus['b_driver_name']; ?> <br />
                                                        <?php echo $bus['b_driver_phone']; ?>
                                                    </td>
                                                    <td><?php echo $bus['b_total_seats']; ?></td>
                                                    <td><?php echo $bus['b_status']; ?></td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <button type="button"
                                                                class="btn btn-link btn-primary btn-lg"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editModal<?php echo $bus['b_id']; ?>">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <a type="button" title="view seats availability"
                                                                class="btn btn-link w-100 mt-1"
                                                                href="./view-seats.php?b_id=<?php echo $bus['b_id']; ?>">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modal for Editing -->
                                                <div class="modal fade" id="editModal<?php echo $bus['b_id']; ?>"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title">Edit Bus Details</h5>
                                                                <button type="button" class="btn btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="./Controllers/Bus.php">
                                                                    <input type="hidden" name="busId"
                                                                        value="<?php echo $bus['b_id']; ?>" />
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Name</label>
                                                                                <input required name="bName" type="text"
                                                                                    class="form-control"
                                                                                    value="<?php echo $bus['b_name']; ?>" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 pe-0">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Driver Name</label>
                                                                                <input required name="dName" type="text"
                                                                                    class="form-control"
                                                                                    value="<?php echo $bus['b_driver_name']; ?>" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Driver Contact Number</label>
                                                                                <input required name="dPhone"
                                                                                    type="text" class="form-control"
                                                                                    value="<?php echo $bus['b_driver_phone']; ?>"
                                                                                    pattern="^[6-9]\d{9}$"
                                                                                    title="Must be exactly 10 digits starting with 6, 7, 8, or 9." />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Bus Number</label>
                                                                                <input required name="bNumber"
                                                                                    type="text" class="form-control"
                                                                                    value="<?php echo $bus['b_number']; ?>"
                                                                                    pattern="^[A-Z]{2}\s\d{1,2}\s[A-Z]{1,2}\s\d{4}$"
                                                                                    title="Format: 'XX 00 XX 0000' (e.g., MH 12 AB 1234)" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Available Seats</label>
                                                                                <input required name="seats" disabled
                                                                                    type="number" class="form-control"
                                                                                    value="<?php echo $bus['b_total_seats']; ?>"
                                                                                    min="20" max="50" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Bus Type</label>
                                                                                <select class="form-control" name="type"
                                                                                    required>
                                                                                    <option value="AC Sleeper"
                                                                                        <?php echo ($bus['b_type'] == 'AC Sleeper') ? 'selected' : ''; ?>>
                                                                                        AC Sleeper</option>
                                                                                    <option value="AC Seater"
                                                                                        <?php echo ($bus['b_type'] == 'AC Seater') ? 'selected' : ''; ?>>
                                                                                        AC Seater
                                                                                    </option>
                                                                                    <option value="VE A/C Sleeper"
                                                                                        <?php echo ($bus['b_type'] == 'VE A/C Sleeper') ? 'selected' : ''; ?>>
                                                                                        VE A/C Sleeper</option>
                                                                                    <option value="NON A/C Seater"
                                                                                        <?php echo ($bus['b_type'] == 'NON A/C Seater') ? 'selected' : ''; ?>>
                                                                                        NON A/C Seater</option>
                                                                                    <option value="NON A/C Sleeper"
                                                                                        <?php echo ($bus['b_type'] == 'NON A/C Sleeper') ? 'selected' : ''; ?>>
                                                                                        NON A/C Sleeper</option>
                                                                                    <option
                                                                                        value="VE Executive A/C Sleeper"
                                                                                        <?php echo ($bus['b_type'] == 'VE Executive A/C Sleeper') ? 'selected' : ''; ?>>
                                                                                        VE Executive
                                                                                        A/C Sleeper</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-default">
                                                                                <label>Bus Status</label>
                                                                                <select class="form-control"
                                                                                    name="status" required>
                                                                                    </option>
                                                                                    <option value="Available"
                                                                                        <?php echo ($bus['b_status'] == 'Available') ? 'selected' : ''; ?>>
                                                                                        Available</option>
                                                                                    <option value="Unavailable"
                                                                                        <?php echo ($bus['b_status'] == 'Unavailable') ? 'selected' : ''; ?>>
                                                                                        Unavailable
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button name="updateBus" type="submit"
                                                                            class="btn btn-primary">Update</button>
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal"
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