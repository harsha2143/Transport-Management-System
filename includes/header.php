<!-- Topbar Start -->
<!-- <div class="container-fluid topbar bg-secondary d-none d-xl-block w-100">
    <div class="container">
        <div class="row gx-0 align-items-center" style="height: 45px;">
            <div class="col-lg-6 text-center text-lg-start mb-lg-0">
                <div class="d-flex flex-wrap">
                    <a href="#" class="text-muted me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A
                        Location</a>
                    <a href="tel:+01234567890" class="text-muted me-4"><i
                            class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a>
                    <a href="mailto:example@gmail.com" class="text-muted me-0"><i
                            class="fas fa-envelope text-primary me-2"></i>Example@gmail.com</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-end">
                <div class="d-flex align-items-center justify-content-end">
                    <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i
                            class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#" class="btn btn-light btn-sm-square rounded-circle me-0"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Topbar End -->

<div class="container-fluid nav-bar sticky-top px-0 px-lg-4 py-2 py-lg-0">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="" class="navbar-brand p-0">
                <h1 class="display-6 text-primary"><i class="fas fa-bus-alt me-3"></i></i>TMS</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="trip.php" class="nav-item nav-link">Trip</a>
                    <?php if (isset($_SESSION['c_id'])) { ?>
                        <a href="./myBookings.php" class="nav-item nav-link">Bookings</a>
                    <?php } ?>

                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="feature.php" class="dropdown-item">Our Feature</a>
                            <a href="cars.php" class="dropdown-item">Our Cars</a>
                            <a href="team.php" class="dropdown-item">Our Team</a>
                            <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                            <a href="404.php" class="dropdown-item">404 Page</a>
                        </div>
                    </div> -->
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
                <?php
                if (!isset($_SESSION['c_id'])) { ?>
                    <a href="./login.php" class="btn btn-primary rounded-pill py-2 px-4">Login</a>
                    <?php
                } else {
                    ?>
                    <div class="d-flex justify-content-between align-items-center" style="gap:10px">
                        <div class="d-flex pt-3 justify-content-center align-items-center">
                            <p class="">Hy, <?php echo $customer['c_username']; ?></p>
                        </div>
                        <div class="d-flex ">
                            <a onclick="return confirm('Are you sure, want to logout?')"
                                href="./Controllers/Authentication.php?condition=logout"
                                class="btn btn-primary rounded-pill py-2 px-4">Logout</a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </nav>
    </div>
</div>