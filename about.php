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
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">About Us</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active text-primary">About</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-fluid overflow-hidden about py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item">
                        <div class="pb-5">
                            <h1 class="display-5 text-capitalize">About <span class="text-primary">Our TMS</span></h1>
                            <p class="mb-0">Our Transport Management System is designed to provide a smooth and
                                efficient booking experience for passengers, streamlining travel across multiple
                                destinations. With years of industry expertise, we offer reliable services that ensure
                                comfort, convenience, and affordability for every journey.</p>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="about-item-inner border p-4">
                                    <div class="about-icon mb-4">
                                        <img src="img/about-icon-1.png" class="img-fluid w-50 h-50" alt="Icon">
                                    </div>
                                    <h5 class="mb-3">Our Vision</h5>
                                    <p class="mb-0">To be the leading provider of innovative and seamless transport
                                        solutions for passengers worldwide.</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="about-item-inner border p-4">
                                    <div class="about-icon mb-4">
                                        <img src="img/about-icon-2.png" class="img-fluid h-50 w-50" alt="Icon">
                                    </div>
                                    <h5 class="mb-3">Our Mission</h5>
                                    <p class="mb-0">To make travel easy, affordable, and accessible through cutting-edge
                                        technology and a customer-centric approach.</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-item my-4">With a deep understanding of the transport industry, we’ve designed
                            our system to handle everything from bookings to real-time tracking, ensuring a hassle-free
                            experience for our users. Our commitment to quality and innovation is at the core of what we
                            do.</p>
                        <div class="row g-4">
                            <!-- <div class="col-lg-6">
                                <div class="text-center rounded bg-secondary p-4">
                                    <h1 class="display-6 text-white">17</h1>
                                    <h5 class="text-light mb-0">Years Of Experience</h5>
                                </div>
                            </div> -->
                            <div class="col-lg-6">
                                <div class="rounded">
                                    <p class="mb-2"><i class="fa fa-check-circle text-primary me-1"></i> Reliable
                                        transport services</p>
                                    <p class="mb-2"><i class="fa fa-check-circle text-primary me-1"></i> Seamless ticket
                                        booking</p>
                                    <p class="mb-2"><i class="fa fa-check-circle text-primary me-1"></i> Real-time bus
                                        tracking</p>
                                    <p class="mb-0"><i class="fa fa-check-circle text-primary me-1"></i> 24/7 customer
                                        support</p>
                                </div>
                            </div>
                            <div class="col-lg-5 d-flex align-items-center">
                                <a href="./about.php" class="btn btn-primary rounded py-3 px-5">More About Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="about-img">
                        <div class="img-1">
                            <img src="img/bus1.webp" class="img-fluid rounded h-75 w-100" alt="">
                        </div>
                        <div class="img-2">
                            <img src="img/bus2.webp" class="img-fluid rounded w-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



    <!-- Features Start -->
    <div class="container-fluid feature py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize mb-3">Key <span class="text-primary">Features</span></h1>
                <p class="mb-0">Our Transport Management System offers a seamless and efficient way to book, manage, and
                    experience travel. Enjoy top-notch services with every trip you book.</p>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-xl-4">
                    <div class="row gy-4 gx-0">
                        <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <span class="fa fa-bus fa-2x"></span>
                                </div>
                                <div class="ms-4">
                                    <h5 class="mb-3">Premium Bus Services</h5>
                                    <p class="mb-0">Experience comfort and convenience with our modern fleet of buses
                                        and first-class travel amenities.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <span class="fa fa-clock fa-2x"></span>
                                </div>
                                <div class="ms-4">
                                    <h5 class="mb-3">24/7 Customer Support</h5>
                                    <p class="mb-0">Our support team is available around the clock to assist with
                                        bookings and any travel inquiries.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                    <img src="img/bus.png" class="img-fluid w-100" style="object-fit: cover;" alt="TMS Features Image">
                </div>
                <div class="col-xl-4">
                    <div class="row gy-4 gx-0">
                        <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="feature-item justify-content-end">
                                <div class="text-end me-4">
                                    <h5 class="mb-3">Affordable Pricing</h5>
                                    <p class="mb-0">Enjoy competitive pricing with no hidden charges, offering you the
                                        best value for your trips.</p>
                                </div>
                                <div class="feature-icon">
                                    <span class="fa fa-wallet fa-2x"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="feature-item justify-content-end">
                                <div class="text-end me-4">
                                    <h5 class="mb-3">Hassle-Free Booking</h5>
                                    <p class="mb-0">Easily book, manage, and track your trips with our user-friendly
                                        platform from anywhere, at any time.</p>
                                </div>
                                <div class="feature-icon">
                                    <span class="fa fa-calendar-check fa-2x"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

    <!-- Car Steps Start -->
    <div class="container-fluid steps py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize text-white mb-3">Our<span class="text-primary"> Booking
                        Process</span></h1>
                <p class="mb-0 text-white">Booking your next trip with us is simple and efficient. Follow these easy
                    steps to get your tickets and start your journey.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="steps-item p-4 mb-4">
                        <h4>Select Your Route</h4>
                        <p class="mb-0">Choose your departure and destination cities, along with the date of travel.</p>
                        <div class="steps-number">01.</div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="steps-item p-4 mb-4">
                        <h4>Pick Your Seat</h4>
                        <p class="mb-0">Browse the available seats and select the one that best suits your needs for the
                            journey.</p>
                        <div class="steps-number">02.</div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="steps-item p-4 mb-4">
                        <h4>Confirm & Pay</h4>
                        <p class="mb-0">Finalize your booking with secure payment, and receive your ticket instantly via
                            email or SMS.</p>
                        <div class="steps-number">03.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Car Steps End -->


    <!-- Banner Start -->
    <div class="container-fluid banner pb-5 wow zoomInDown mt-5" data-wow-delay="0.1s">
        <div class="container pb-5">
            <div class="banner-item rounded">
                <img src="img/bg1.jpg" class="img-fluid rounded w-100" alt="">
                <div class="banner-content">
                    <h2 class="text-primary">Plan Your Journey</h2>
                    <h1 class="text-white">Looking for Bus Tickets?</h1>
                    <p class="text-white">Get more information or reach out to us today.</p>
                    <div class="banner-btn">
                        <a href="about.php" class="btn btn-secondary rounded-pill py-3 px-4 px-md-5 me-2">About Us</a>
                        <a href="contact.php" class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

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