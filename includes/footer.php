<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="footer-item d-flex flex-column">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">About Us</h4>
                        <p class="mb-3">Experience seamless travel with TMS, where convenience meets reliability in
                            every trip, ensuring a smooth journey from start to finish.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-6">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4">Quick Links</h4>
                    <a href="index.php"><i class="fas fa-angle-right me-2"></i> Home</a>
                    <a href="about.php"><i class="fas fa-angle-right me-2"></i> About</a>
                    <a href="contact.php"><i class="fas fa-angle-right me-2"></i> Contact us</a>
                    <?php if (!isset($_SESSION['c_id'])) { ?>
                        <a href="login.php"><i class="fas fa-angle-right me-2"></i> Login</a>
                    <?php } else { ?>
                        <a href="myBookings.php"><i class="fas fa-angle-right me-2"></i> My Bookings</a>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-12 text-center mb-md-0">
                <span class="text-body"><a href="index.php" class="border-bottom text-white"><i
                            class="fas fa-copyright text-light me-2"></i>TMS Bus Ticket Booking</a>, All right
                    reserved.</span>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->