<?php
include './config.php';
$admin = new Admin();

if (isset($_SESSION['c_id'])) {
    $cid = $_SESSION['c_id'];
    $getCustomer = $admin->ret("SELECT * FROM `customer` where `c_id`='$cid'");
    $customer = $getCustomer->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location:./login.php");
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

     Spinner Start
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
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Booking History</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active text-primary">Bookings</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Services Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <!-- <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize mb-3">TMS <span class="text-primary">Booking History</span>
                </h1>
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut amet nemo expedita
                    asperiores commodi accusantium at cum harum, excepturi, quia tempora cupiditate! Adipisci facilis
                    modi quisquam quia distinctio,
                </p>
            </div> -->
            <div class="row g-4">
                <?php

                $getTrips = $admin->ret("SELECT * FROM `bookings` INNER JOIN `trip` ON trip.t_id = bookings.t_id INNER JOIN `bus` ON bus.b_id = trip.b_id where `c_id`='$cid' order by bk_id desc");
                $number = $getTrips->rowCount();
                if ($number > 0) {
                    while ($trip = $getTrips->fetch(PDO::FETCH_ASSOC)) {
                        $bkid = $trip['bk_id'];
                        ?>
                    
                <div class="col-md-6 col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item p-4">
                    <div id="ticket_<?php echo $bkid; ?>">
                        <div class="table-responsive d-flex justify-content-lg-start text-start  w-100">
                            <table class="table" style="border:0px solid white">
                                <tr>
                                    <th><?php echo $trip['b_name']; ?></th>
                                    <th>
                                        <?php
                                                // Convert to timestamp
                                                $timestamp = strtotime($trip['t_date']);

                                                // Format the date and time separately
                                                $formattedDate = date('Y-m-d', $timestamp); // Date in YYYY-MM-DD format
                                                $formattedTime = date('H:i', $timestamp);   // Time in HH:MM format
                                        
                                                echo $formattedDate . ' | ' . $formattedTime; // Display separated
                                                ?>
                                    </th>
                                    <td></td>
                                    <th class="d-flex justify-content-lg-end">
                                        <?php
                                                $startDateTime = strtotime($trip['t_date']);
                                                $tripDuration = $trip['t_duration'];
                                                $durationInSeconds = $tripDuration * 3600;
                                                $arrivalTime = $startDateTime + $durationInSeconds;

                                                // Format the arrival date and time
                                                $formattedArrivalDate = date('Y-m-d', $arrivalTime); // Date in YYYY-MM-DD format
                                                $formattedArrivalTime = date('H:i', $arrivalTime);   // Time in HH:MM format
                                        
                                                // Display the separated date and time
                                                echo $formattedArrivalDate . ' | ' . $formattedArrivalTime;
                                                ?>
                                    </th>
                                </tr>
                                <tr>
                                    <td><?php echo $trip['b_type']; ?></td>
                                    <td><?php echo $trip['t_from']; ?></td>
                                    <td>via <?php echo $trip['t_root']; ?> (<?php echo $trip['t_duration']; ?>hrs)</td>
                                    <td class="d-flex justify-content-lg-end"><?php echo $trip['t_to']; ?></td>
                                </tr>
                                <tr>
                                    <td>Total Ticket Fair : ₹<?php echo $trip['bk_total_fair']; ?></td>
                                    <td>Payment Status : <?php echo $trip['bk_payment_status']; ?></td>
                                    <td>Booking Status : <?php echo $trip['bk_status']; ?></td>
                                    <td class="d-flex justify-content-lg-end">Passenger Count : <?php
                                            $getPassengers = $admin->ret("SELECT * FROM `passenger` WHERE  `bk_id`='$bkid'");
                                            echo $getCount = $getPassengers->rowCount();
                                            ?></td>
                                    <!-- <td colspan="2">
                                                <div class="d-flex justify-content-lg-end  w-100">

                                                    <a href="./login.php" title="login to view seats availability"
                                                        class="service-icon mb-4 p-2 fw-bold text-white fs-10"
                                                        style="border:none">
                                                        View Seats
                                                    </a>

                                                </div>
                                            </td> -->
                                </tr>
                                <tr>
                                    <td colspan="2">Seats : <?php
                                            $getPassengerSeats = $admin->ret("SELECT * FROM `passenger` INNER JOIN `seats` ON seats.s_id = passenger.s_id WHERE `bk_id` = '$bkid'");
                                            $seatsList = [];

                                            while ($seats = $getPassengerSeats->fetch(PDO::FETCH_ASSOC)) {
                                                $seatsList[] = $seats['s_number'];
                                            }

                                            // Join the seat numbers with a comma or pipe
                                            echo implode(' | ', $seatsList);
                                            ?></td>
                                    <th colspan="2">Passengers</th>
                                </tr>
                                <tr>
                                <tr>
                                    <td></td>
                                    <td>Passenger Name</td>
                                    <td>Passenger Age</td>
                                    <td>Ticket</td>
                                </tr>
                                <?php
                                        $getPassengerSeats = $admin->ret("SELECT * FROM `passenger` INNER JOIN `seats` ON seats.s_id = passenger.s_id WHERE `bk_id` = '$bkid'");
                                        while ($seats = $getPassengerSeats->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $seats['ps_name']; ?> ( <?php echo $seats['ps_gender']; ?> ) -
                                        <?php echo $seats['s_number']; ?>
                                    </td>
                                    <td><?php echo $seats['ps_age']; ?></td>
                                    <td><?php echo $seats['ps_ticket']; ?></td>
                                </tr>
                                <?php } ?>
                                </tr>
                            </table>
                                        </div>

                        </div>
                        <button onclick="printTicket('ticket_<?php echo $bkid; ?>')">Download Ticket</button>


                        <!-- <h5 class="mb-3">Phone Reservation</h5>
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit ipsam
                            quasi quibusdam ipsa perferendis iusto?</p> -->
                    </div>
                </div>
                <?php }
                } else { ?>
                <div class="col-md-6 col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item p-4">
                        <div class="service-icon mb-4" style="width:40px">
                            <h1 class="text-white">!</h1>
                        </div>
                        <h5 class="mb-3">No Booking History</h5>

                    </div>
                </div>
                <?php } ?>


            </div>
        </div>
    </div>
    <!-- Services End -->

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
    <script>
        function printTicket(ticketId) {
        var content = document.getElementById(ticketId).innerHTML;
        var myWindow = window.open('', '', 'width=800,height=600');
        myWindow.document.write('<html><head><title>Ticket</title>');
        myWindow.document.write('<link rel="stylesheet" href="css/bootstrap.min.css">'); // Include Bootstrap styles
        myWindow.document.write('</head><body>');
        myWindow.document.write(content);
        myWindow.document.write('</body></html>');
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.close();
    }
</script>


    <!-- Template Javascript -->
    <script src="js/main.js">
        
    </script>
</body>

</html>