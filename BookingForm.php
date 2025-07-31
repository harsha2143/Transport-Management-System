<?php
include './config.php';
$admin = new Admin();

if (isset($_SESSION['c_id'])) {
    $cid = $_SESSION['c_id'];
    $getCustomer = $admin->ret("SELECT * FROM `customer` where `c_id`='$cid'");
    $customer = $getCustomer->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TMS | Bus Ticket Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->



    <!-- Navbar & Hero Start -->
    <?php include './includes/header.php'; ?>
    <!-- Navbar & Hero End -->

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Booking Form</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active text-primary">Book Your tickets</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Services Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
             <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize mb-3">TMS <span class="text-primary">Book Your tickets</span>
                </h1>
               
            </div> 

            <form method='POST' action='./Controllers/BookTicket.php'>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $bid = $_POST['bid'];
                    $tid = $_POST['tid'];

                    // Check if any seats were selected
                    if (isset($_POST['seats']) && !empty($_POST['seats'])) {
                        // Get the selected seat IDs
                        $selectedSeats = $_POST['seats'];
                        $seatCount = count($selectedSeats); // Get the count of selected seats
                
                        // Display the selected seat IDs
                        echo "<h3>Selected Seats</h3>";
                        echo "<ul>";
                        foreach ($selectedSeats as $seatId) {
                            $getSeats = $admin->ret("SELECT * FROM `seats` WHERE `s_id`='$seatId'");
                            while ($seat = $getSeats->fetch(PDO::FETCH_ASSOC)) {
                                echo "<li>Seat : " . $seat['s_number'] . "</li>";
                                // Use 'seatIds[]' so that it captures all selected seat IDs
                                echo "<input value='" . $seat['s_id'] . "' type='hidden' name='seatIds[]'/> ";
                            }
                        }
                        echo "</ul>"; ?>

                <!-- Hidden fields for bid and tid -->
                <input type="hidden" value="<?php echo $bid; ?>" name="bid">
                <input type="hidden" value="<?php echo $tid; ?>" name="tid">

                <!-- Passenger Details Section -->
                <div class="card p-3 wow fadeInUp" data-wow-delay="0.4s">
                    <h3 class="text-center">Passenger Details</h3>
                    <?php foreach ($selectedSeats as $index => $seatId) {
                                $getSeats = $admin->ret("SELECT * FROM `seats` WHERE `s_id`='$seatId'");
                                while ($seat = $getSeats->fetch(PDO::FETCH_ASSOC)) {
                                    ?>

                    <div class="card form-group p-3 mb-2">
                        <div class="d-flex justify-content-between">
                            <h6>Passenger <?php echo $index + 1; ?> </h6>
                            <h6>Seat Number : <?php echo $seat['s_number'] ?></h6>
                        </div>
                        <label for="name_<?php echo $index; ?>">Name:</label>
                        <input type="text" class="form-control" name="passenger[<?php echo $index; ?>][name]" required>

                        <label for="age_<?php echo $index; ?>">Age:</label>
                        <input type="number" class="form-control" name="passenger[<?php echo $index; ?>][age]" required>

                        <label for="gender_<?php echo $index; ?>">Gender:</label>
                        <div style="gap:5px" class="d-flex">
                            <label for="gender"></label>
                            <input required type="radio" name="passenger[<?php echo $index; ?>][gender]"
                                value="Male" />Male
                            <input required type="radio" name="passenger[<?php echo $index; ?>][gender]"
                                value="Female" />Female
                            <input required type="radio" name="passenger[<?php echo $index; ?>][gender]"
                                value="Other" />Other
                        </div>
                    </div>
                    <?php }
                            } ?>
                </div>

                <!-- Contact Details Section -->
                <div class="card mt-3 p-3 wow fadeInUp" data-wow-delay="0.4s">
                    <h3 class="text-center">Contact Details</h3>
                    <div class="card form-group p-3 mb-2">
                        <label for="name_contact">Name</label>
                        <input type="text" class="form-control" name="name" required>

                        <label for="phone">Contact Number</label>
                        <input type="number" class="form-control" name="phone" required>

                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" required>

                        <div class="mt-2 d-flex justify-content-between p-2">
                            <p class="fw-bold">Ticket Fare</p>
                            <p class="fw-bold">₹<?php echo $_POST['ticketFare']; ?></p>
                            <input type="hidden" value="<?php echo $_POST['ticketFare']; ?>" name="ticketFare">
                        </div>
                        <div>
                            <div class="d-flex justify-content-center align-items-center "
                                style="flex-direction:column">
                                <img src="./img/qr.png" alt="" style="width:200px">
                                <h4>₹<?php echo $_POST['ticketFare']; ?></h4>
                            </div>
                            <div class="d-flex justify-content-center align-items-center ">
                                <input type="text" class="form-control w-50" placeholder="enter transaction id here"
                                    required name="trid">
                            </div>
                        </div>
                    </div>
                    <button type='submit' class='btn btn-primary' name="book">Book Tickets</button>
                </div>

                <?php
                    } else {
                        // No seats were selected
                        echo "<script>alert('No seats were selected. Please go back and select at least one seat.');window.location='./view-seats.php?b_id=$bid&t_id=$tid';</script>";
                    }
                }
                ?>
            </form>

        </div>
    </div>


    <!-- CSS for seating layout -->


    <!-- Footer Start -->
    <?php include './includes/footer.php'; ?>
    <!-- Footer End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>