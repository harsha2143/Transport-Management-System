<?php
include '../config.php';
$admin = new Admin();

if (isset($_SESSION['c_id'])) {
    if (isset($_POST['book'])) {
        $cid = $_SESSION['c_id'];
        // Get contact details
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $trid = $_POST['trid'];

        // Get booking ID, ticket ID, and selected seats
        $tid = $_POST['tid'];
        $ticketFare = $_POST['ticketFare'];
        $bookingDate = date('Y-m-d'); // Current date for the booking

        // Validate contact details
        if (empty($name) || empty($phone) || empty($email)) {
            echo "<script>alert('All contact details must be provided!');window.history.back();</script>";
            exit;
        }

        // Ensure 'seatIds' and 'passenger' exist and are arrays
        if (!isset($_POST['seatIds']) || !is_array($_POST['seatIds'])) {
            echo "<script>alert('Invalid seat selection data!');window.history.back();</script>";
            exit;
        }

        if (!isset($_POST['passenger']) || !is_array($_POST['passenger'])) {
            echo "<script>alert('Invalid passenger data!');window.history.back();</script>";
            exit;
        }

        try {
            // Database connection (if not part of the Admin class)
            $conn = new mysqli("localhost", "root", "", "bus-booking");
            if ($conn->connect_error) {
                throw new Exception("Database connection failed: " . $conn->connect_error);
            }
        
            // Insert booking details
            $stmt = $conn->prepare("INSERT INTO bookings (bk_date, c_id, t_id, bk_name, bk_phone, bk_email, bk_total_fair, bk_transaction_id, bk_payment_status, bk_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
            $paymentStatus = "Paid"; // Assuming payment is successful
            $bookingStatus = "Booked";
        
            $stmt->bind_param("siisssisss", $bookingDate, $cid, $tid, $name, $phone, $email, $ticketFare, $trid, $paymentStatus, $bookingStatus);
            $stmt->execute();
        
            // Get the inserted booking ID
            $bookingId = $stmt->insert_id;
            $stmt->close();
        
            // Insert passenger details
            $stmt = $conn->prepare("INSERT INTO passenger (ps_name, ps_age, ps_gender, bk_id, s_id, ps_ticket, ps_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            
            foreach ($_POST['passenger'] as $index => $passenger) {
                $seatId = $_POST['seatIds'][$index];
                $psName = $passenger['name'];
                $psAge = $passenger['age'];
                $psGender = $passenger['gender'];
                $ticketNumber = "TCKT" . time() . rand(100, 999); // Generate a unique ticket ID
                $psStatus = "Confirmed";
        
                $stmt->bind_param("ssssiss", $psName, $psAge, $psGender, $bookingId, $seatId, $ticketNumber, $psStatus);
                $stmt->execute();
        
                // Update seat status
                $conn->query("UPDATE seats SET s_status = 'Booked' WHERE s_id = $seatId");
            }
        
            $stmt->close();
            $conn->close();
        
            echo "<script>alert('Booking successful!');window.location='../myBookings.php';</script>";
        
        } catch (Exception $e) {
            echo "<script>alert('An error occurred: " . $e->getMessage() . "');window.history.back();</script>";
        }
        
    } else {
        echo "<script>alert('No booking data received.');window.history.back();</script>";
    }
} else {
    echo "<script>alert('You are not logged in to book the seat! Login and try again');window.location='../login.php';</script>";

}
?>