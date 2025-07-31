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
    <style>
    .seat-layout {
        display: flex;
        flex-direction: column;
        gap: 15px;
        /* Gap between rows */
        margin-top: 15px;
    }

    .seat-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        /* Space between rows */
    }

    .seat {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f8f9fa;
        cursor: pointer;
        width: 14%;
        /* Adjust width */
    }

    .booked-seat {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: grey;
        color: black;
        font-weight: 600;
        cursor: not-allowed;
        width: 14%;
        opacity: 50%;
    }

    .booked-for-female {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        border: 2px solid red;
        border-radius: 5px;
        background-color: grey;
        color: black;
        font-weight: 600;
        cursor: not-allowed;
        width: 14%;
        opacity: 50%;
    }

    .seat2 {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f8f9fa;
        cursor: pointer;
        width: 14%;
        /* Adjust width */
    }

    .lower-deck .seat {
        background-color: #d1e7dd;
        /* Light green for lower deck */
    }

    .upper-deck .seat {
        background-color: #ffeeba;
        /* Light yellow for upper deck */
    }

    .seat.selected {
        background-color: green;
        color: white;
    }

    /* Door space */
    .door-space {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
    }

    .door {
        padding: 10px;
        background-color: #ffc107;
        border-radius: 5px;
        font-weight: bold;
        color: black;
    }

    .booking-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        /* padding: 20px; */
        width: 350px;
        /* margin: 0 auto; */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-weight: bold;
        color: #333;
    }

    .change-link {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .boarding-details p {
        margin-bottom: 5px;
    }

    .seat-info,
    .fare-details {
        border-top: 1px solid #ddd;
        padding-top: 10px;
    }

    .fare-details-link {
        display: block;
        margin-top: 10px;
        color: #ff5a5f;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-block {
        width: 100%;
    }

    .btn-danger {
        background-color: #ff5a5f;
        border: none;
        color: white;
        padding: 10px;
        font-size: 16px;
        border-radius: 4px;
    }

    .text-danger {
        color: red;
    }
    </style>
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
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Seats Availability</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active text-primary">Seats Availability</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Services Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <!-- <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize mb-3">TMS <span class="text-primary">Seats Availability</span></h1>
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut amet nemo expedita
                    asperiores commodi accusantium at cum harum, excepturi, quia tempora cupiditate! Adipisci facilis
                    modi quisquam quia distinctio,
                </p>
            </div> -->
            <form method="POST" action="./bookingForm.php">
                <div class="row g-4 d-flex justify-content-between">
                    <?php
                    if (isset($_GET['b_id'])) {
                        $busId = $_GET['b_id'];
                        $getSeats = $admin->ret("SELECT * FROM `seats` INNER JOIN `bus` ON bus.b_id = seats.b_id WHERE bus.b_id='$busId'");

                        $lowerSeats = [];
                        $upperSeats = [];

                        while ($seat = $getSeats->fetch(PDO::FETCH_ASSOC)) {
                            if (strpos($seat['s_number'], 'L') === 0) {
                                $lowerSeats[] = $seat;
                            } else if (strpos($seat['s_number'], 'U') === 0) {
                                $upperSeats[] = $seat;
                            }
                        }
                        ?>

                    <div class="card col-md-8 p-5  wow fadeInUp" data-wow-delay="0.1s">
                        <h4>Lower Deck</h4>
                        <div class="seat-layout lower-deck">
                            <!-- First 12 Seats (6 in a row, 2 rows) -->
                            <div class="d-flex">
                                <div class="steering p-2">
                                    <img src="./img/steering.png" alt="steering" style="width:30px;opacity:50%">
                                </div>
                                <div class="w-100">
                                    <div class="seat-row">
                                        <?php foreach (array_slice($lowerSeats, 0, 6) as $seat) { ?>
                                        <div class="<?php
                                                if ($seat['s_status'] == "Booked") {
                                                    echo 'booked-seat';
                                                } else {
                                                    echo 'seat';
                                                }
                                                ?>" data-seat-id="<?php echo $seat['s_id']; ?>"
                                            data-status="<?php echo $seat['s_status']; ?>"
                                            onclick="<?php echo ($seat['s_status'] == 'Booked') ? 'return false;' : 'toggleSeat(this)'; ?>">
                                            <label
                                                for="<?php echo $seat['s_id']; ?>"><?php echo $seat['s_number']; ?></label>
                                            <input type="checkbox" name="seats[]" value="<?php echo $seat['s_id']; ?>"
                                                id="<?php echo $seat['s_id']; ?>" class="seat-checkbox"
                                                style="display:none;">
                                        </div>
                                        <?php } ?>
                                    </div>

                                    <div class="seat-row">
                                        <?php foreach (array_slice($lowerSeats, 6, 6) as $seat) { ?>
                                        <div class="<?php
                                                if ($seat['s_status'] == "Booked") {
                                                    echo 'booked-seat';
                                                } else {
                                                    echo 'seat';
                                                }
                                                ?>" data-seat-id="<?php echo $seat['s_id']; ?>"
                                            data-status="<?php echo $seat['s_status']; ?>"
                                            onclick="<?php echo ($seat['s_status'] == 'Booked') ? 'return false;' : 'toggleSeat(this)'; ?>">
                                            <label
                                                for="<?php echo $seat['s_id']; ?>"><?php echo $seat['s_number']; ?></label>
                                            <input type="checkbox" name="seats[]" value="<?php echo $seat['s_id']; ?>"
                                                id="<?php echo $seat['s_id']; ?>" class="seat-checkbox"
                                                style="display:none;">
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Remaining Seats -->
                            <div class="seat-row">
                                <div class="seat2"></div>
                                <?php foreach (array_slice($lowerSeats, 12) as $seat) { ?>
                                <div class="<?php
                                        if ($seat['s_status'] == "Booked") {
                                            echo 'booked-seat';
                                        } else {
                                            echo 'seat';
                                        }
                                        ?>" data-seat-id="<?php echo $seat['s_id']; ?>"
                                    data-status="<?php echo $seat['s_status']; ?>"
                                    onclick="<?php echo ($seat['s_status'] == 'Booked') ? 'return false;' : 'toggleSeat(this)'; ?>">
                                    <label for="<?php echo $seat['s_id']; ?>"><?php echo $seat['s_number']; ?></label>
                                    <input type="checkbox" name="seats[]" value="<?php echo $seat['s_id']; ?>"
                                        id="<?php echo $seat['s_id']; ?>" class="seat-checkbox" style="display:none;">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-3 p-5 d-flex justify-content-center align-items-center wow fadeInUp"
                        style="width: 350px;" data-wow-delay="0.1s">
                        <div class="w-100">
                            <div class="d-flex justify-content-lg-start align-items-center" style="gap:5px">
                                <div class="seat" style="background-color:#d1e7dd"></div>
                                <p class="pt-2">Available Lower Berth</p>
                            </div>
                            <div class="d-flex justify-content-lg-start align-items-center" style="gap:5px">
                                <div class="seat" style="background-color:#ffeeba"></div>
                                <p class="pt-2">Available Upper Berth</p>
                            </div>
                            <div class="d-flex justify-content-lg-start align-items-center" style="gap:5px">
                                <div class="seat" style="background-color:green"></div>
                                <p class="pt-2">Selected</p>
                            </div>
                            <div class="d-flex justify-content-lg-start align-items-center" style="gap:5px">
                                <div class="seat" style="background-color:grey;opacity:50%"></div>
                                <p class="pt-2">Booked</p>
                            </div>
                            <!-- <div class="d-flex justify-content-lg-start align-items-center" style="gap:5px">
                                <div class="seat" style="background-color:grey;opacity:50%;border: 2px solid red;">
                                </div>
                                <p class="pt-2">Booked for Female</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="card col-md-8 p-5 wow fadeInUp" data-wow-delay="0.1s">
                        <h4>Upper Deck</h4>
                        <div class="seat-layout upper-deck">
                            <!-- First 12 Seats (6 in a row, 2 rows) -->
                            <div class="seat-row">
                                <?php foreach (array_slice($upperSeats, 0, 6) as $seat) { ?>
                                <div class="<?php
                                        if ($seat['s_status'] == "Booked") {
                                            echo 'booked-seat';
                                        } else {
                                            echo 'seat';
                                        }
                                        ?>" data-seat-id="<?php echo $seat['s_id']; ?>"
                                    data-status="<?php echo $seat['s_status']; ?>"
                                    onclick="<?php echo ($seat['s_status'] == 'Booked') ? 'return false;' : 'toggleSeat(this)'; ?>">
                                    <label for="<?php echo $seat['s_id']; ?>"><?php echo $seat['s_number']; ?></label>
                                    <input type="checkbox" name="seats[]" value="<?php echo $seat['s_id']; ?>"
                                        id="<?php echo $seat['s_id']; ?>" class="seat-checkbox" style="display:none;">
                                </div>
                                <?php } ?>
                            </div>

                            <div class="seat-row">
                                <?php foreach (array_slice($upperSeats, 6, 6) as $seat) { ?>
                                <div class="<?php
                                        if ($seat['s_status'] == "Booked") {
                                            echo 'booked-seat';
                                        } else {
                                            echo 'seat';
                                        }
                                        ?>" data-seat-id="<?php echo $seat['s_id']; ?>"
                                    data-status="<?php echo $seat['s_status']; ?>"
                                    onclick="<?php echo ($seat['s_status'] == 'Booked') ? 'return false;' : 'toggleSeat(this)'; ?>">
                                    <label for="<?php echo $seat['s_id']; ?>"><?php echo $seat['s_number']; ?></label>
                                    <input type="checkbox" name="seats[]" value="<?php echo $seat['s_id']; ?>"
                                        id="<?php echo $seat['s_id']; ?>" class="seat-checkbox" style="display:none;">
                                </div>
                                <?php } ?>
                            </div>

                            <!-- Remaining Seats -->
                            <div class="seat-row">
                                <div class="seat2"></div>
                                <?php foreach (array_slice($upperSeats, 12) as $seat) { ?>
                                <div class="<?php
                                        if ($seat['s_status'] == "Booked") {
                                            echo 'booked-seat';
                                        } else {
                                            echo 'seat';
                                        }
                                        ?>" data-seat-id="<?php echo $seat['s_id']; ?>"
                                    data-status="<?php echo $seat['s_status']; ?>"
                                    onclick="<?php echo ($seat['s_status'] == 'Booked') ? 'return false;' : 'toggleSeat(this)'; ?>">
                                    <label for="<?php echo $seat['s_id']; ?>"><?php echo $seat['s_number']; ?></label>
                                    <input type="checkbox" name="seats[]" value="<?php echo $seat['s_id']; ?>"
                                        id="<?php echo $seat['s_id']; ?>" class="seat-checkbox" style="display:none;">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!-- Section to display selected seats -->

                    <div class="card col-md-3 p-5 booking-card">
                        <div class="card-body">
                            <!-- Boarding and Dropping Details -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Boarding & Dropping</h5>
                                <a href="./index.php" class="change-link">CHANGE</a>
                            </div>
                            <?php
                                if (isset($_GET['t_id'])) {
                                    $tid = $_GET['t_id'];
                                    $getTrip = $admin->ret("SELECT * FROM `trip` INNER JOIN `bus` ON bus.b_id = trip.b_id where `t_id`='$tid'");
                                    $trip = $getTrip->fetch(PDO::FETCH_ASSOC);

                                    ?>
                            <div class="boarding-details">
                                <p class="mb-1"><strong><?php echo $trip['t_from']; ?></strong><br></p>
                                <p>to</p>
                                <p class="mb-1"><strong><?php echo $trip['t_to']; ?>
                                    </strong><br></p>
                            </div>

                            <!-- Time Information -->
                            <div class="d-flex justify-content-between mb-3">
                                <input type="hidden" id="ticket" value="<?php echo $trip['t_ticket']; ?>">
                                <p><?php
                                        // Convert to timestamp
                                        $timestamp = strtotime($trip['t_date']);

                                        // Format the date and time separately
                                        $formattedDate = date('Y-m-d', $timestamp); // Date in YYYY-MM-DD format
                                        $formattedTime = date('H:i', $timestamp);   // Time in HH:MM format
                                
                                        echo $formattedDate . ' ' . $formattedTime; // Display separated
                                        ?></p>

                                <p class="" style="text-align:right"><?php
                                        $startDateTime = strtotime($trip['t_date']);
                                        $tripDuration = $trip['t_duration'];
                                        $durationInSeconds = $tripDuration * 3600;
                                        $arrivalTime = $startDateTime + $durationInSeconds;

                                        // Format the arrival date and time
                                        $formattedArrivalDate = date('Y-m-d', $arrivalTime); // Date in YYYY-MM-DD format
                                        $formattedArrivalTime = date('H:i', $arrivalTime);   // Time in HH:MM format
                                
                                        // Display the separated date and time
                                        echo $formattedArrivalDate . ' ' . $formattedArrivalTime;
                                        ?> </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="fw-bold">Trip duration </p>
                                <p><?php echo $trip['t_duration']; ?>hrs</p>
                            </div>
                            <?php } ?>
                            <!-- Seat Number -->
                            <div class="seat-info">
                                <p><strong>Seat No.</strong></p>
                                <div id="selected-seats"></div>
                            </div>

                            <!-- Fare Details -->
                            <div class="fare-details">
                                <p><strong>Fare Details</strong></p>
                                <p id="total-fare"></strong></p>
                                <input id="total-fare2" type="hidden" name="ticketFare" />
                                <!-- <small class="text-muted">Taxes will be calculated during payment</small> -->
                            </div>

                            <!-- Fare Details Toggle -->
                            <!-- <a href="#" class="fare-details-link">Show Fare Details</a> -->
                            <input type="hidden" name="bid" value="<?php echo $_GET['b_id']; ?>">
                            <input type="hidden" name="tid" value="<?php echo $_GET['t_id']; ?>">
                            <!-- Proceed to Book Button -->
                            <button type="submit" class="btn btn-danger btn-block mt-3">PROCEED TO BOOK</button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <!-- <div class="col-md-12 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                        <button  class="btn btn-primary">Submit Selected Seats</button>
                    </div> -->
                    <?php
                    } else { ?>
                    <div class="col-md-6 col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item p-4">
                            <div class="service-icon mb-4" style="width:40px">
                                <h1 class="text-white">!</h1>
                            </div>
                            <h5 class="mb-3">No bus selected!</h5>
                        </div>
                    </div>
                    <?php } ?>
            </form>


        </div>




    </div>
    </div>

    <!-- CSS for seating layout -->


    <!-- JavaScript for toggling seat selection -->
    <script>
    // function toggleSeat(seatElement) {
    //     const checkbox = seatElement.querySelector('.seat-checkbox');
    //     const status = seatElement.getAttribute('data-status');

    //     if (status !== 'Booked') {
    //         checkbox.checked = !checkbox.checked; // Toggle checkbox state
    //         seatElement.classList.toggle('selected'); // Toggle selected class
    //     }
    // }

    function toggleSeat(seatElement) {
        const seatCheckbox = seatElement.querySelector('input.seat-checkbox');
        seatCheckbox.checked = !seatCheckbox.checked; // Toggle the checkbox

        // Toggle the background color of the seat based on its selection status
        if (seatCheckbox.checked) {
            seatElement.style.backgroundColor = 'green'; // Selected seat
            seatElement.style.color = 'white'; // Selected seat
        } else {
            seatElement.style.backgroundColor = ''; // Default background color
            seatElement.style.color = 'grey'; // Selected seat
        }

        updateSelectedSeats(); // Update the selected seats section
        calculateTicketFare()
    }


    function calculateTicketFare() {
        var pricePerSeat = document.getElementById('ticket').value;
        const selectedSeats = document.querySelectorAll('input.seat-checkbox:checked');
        let totalFare = 0;

        // Calculate the total fare based on the number of selected seats
        selectedSeats.forEach(seat => {
            totalFare = parseFloat(totalFare) + parseFloat(pricePerSeat);
        });
        // Optionally, display the total fare in the UI
        document.getElementById('total-fare2').value = totalFare
        document.getElementById('total-fare').innerHTML = "Amount: <strong>INR " + totalFare +
            "</strong>";;

    }

    function updateSelectedSeats() {
        const selectedSeatsContainer = document.getElementById('selected-seats');
        const selectedSeats = document.querySelectorAll('input.seat-checkbox:checked');

        // Clear previously displayed seats
        selectedSeatsContainer.innerHTML = '';

        // Create table element
        const table = document.createElement('table');
        table.classList.add('table', 'table-bordered'); // Optional: Add Bootstrap table classes

        // Create table headers
        const thead = document.createElement('thead');
        const headerRow = document.createElement('tr');
        // const headers = ['Seat Number', 'Deck'];
        // headers.forEach(headerText => {
        //     const th = document.createElement('th');
        //     th.innerText = headerText;
        //     headerRow.appendChild(th);
        // });
        // thead.appendChild(headerRow);
        // table.appendChild(thead);

        // Create table body
        const tbody = document.createElement('tbody');

        // Append selected seat data as table rows
        selectedSeats.forEach(seat => {
            const row = document.createElement('tr');

            // Seat Number Column
            const seatNumberCell = document.createElement('td');
            seatNumberCell.innerText = seat.parentElement.querySelector('label').innerText;
            row.appendChild(seatNumberCell);

            // Deck Column (Lower or Upper)
            const deckCell = document.createElement('td');
            const seatNumber = seat.parentElement.querySelector('label').innerText;
            deckCell.innerText = seatNumber.startsWith('L') ? 'Lower Deck' :
                'Upper Deck'; // Assumes 'L' for Lower and 'U' for Upper
            row.appendChild(deckCell);

            tbody.appendChild(row);
        });

        // Append tbody to the table
        table.appendChild(tbody);

        // Append the complete table to the selected-seats container
        selectedSeatsContainer.appendChild(table);
    }
    </script>


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