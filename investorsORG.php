<?php
session_start();

// Check if user is logged in and their role
$isLoggedIn = isset($_SESSION['user_email']) && !empty($_SESSION['user_email']);
$isAdmin = $isLoggedIn && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TURE Investors</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/TURE.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/TURE.ico" type="image/x-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
	
    <style>
        .centered-text {
            width: 50%; /* Adjust width as needed */
            margin: 0 auto; /* Center horizontally */
            text-align: left; /* Align text to the left */
        }
    </style>
	
</head>

<body>
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"><span class="sr-only">Loading...</span></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <div class="icon p-2 me-2"><img class="img-fluid" style="width: 30px; height: 30px;" src="img/icon-deal.png" alt="Icon" /></div>
        <h1 class="m-0 text-primary">Triple Up Real Estate</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"></button>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <div class="navbar-nav ms-auto">
                <a class="nav-item nav-link" href="index.php">Home</a>
                <a class="nav-item nav-link" href="about.php">About</a>
                <a class="nav-item nav-link active" href="investors.php">Investors</a>
                <a class="nav-item nav-link" href="buyers.php">Buyers</a>
                <a class="nav-item nav-link" href="sellers.php">Sellers</a>
                <?php if ($isLoggedIn): ?>
                    <?php if ($isAdmin): ?>
       <a class="nav-item nav-link" href="admin.php" target="_blank">Admin</a>
                    <?php endif; ?>
                    <a class="nav-item nav-link" href="logout.php">Logout</a>
                <?php else: ?>
                    <a class="nav-item nav-link" href="login.php">Login</a>
                    <a class="nav-item nav-link" href="form.php">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Real Estate Investments</h1>
                <h4>Receive 32.5% in just 4 months
					<br>Every 4 months<br>
					Set an appointment and we will show you how  </h4>
            </div>
            <div class="col-md-6 animated fadeIn"><img class="img-fluid" src="img/header.jpg" alt="" /></div>
        </div>
    </div>
    <!-- Header End -->

    <div class="centered-text"><br />
        <h1>More Info</h1>
        <h4>As an example:</h4>
        <p><br />In exchange for $68,500, you would get </p>
        <ul style="list-style-type: circle;">
            <li><strong>A lien on $100,000 worth of property</strong></li>
            <li>$1000 per month</li>
            <li>The ability to pull your money quickly</li>
            <li>and in 4 months a total of 32.5% return.</li>
        </ul>
        <p>We provide a recorded lien on Real Estate that is 32.5% more in value than your investment. If anything goes wrong, you are assured of getting all your money back.</p>
    </div>

    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" style="max-width: 600px;" data-wow-delay="0.1s">
                <h1 class="mb-3">Schedule a Meeting!</h1>
                <!-- Calendly inline widget begin -->
                <div class="calendly-inline-widget" style="min-width: 320px; height: 700px;" data-url="https://calendly.com/360win/triple-up-real-estate?hide_gdpr_banner=1">&nbsp;</div>
                <script src="https://assets.calendly.com/assets/external/widget.js" async="" type="text/javascript"></script>
                <!-- Calendly inline widget end -->
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Get In Touch</h5>
                    <p class="mb-2">333 Mamaroneck Ave #224 <br>White Plains, NY 10605</p>
                    <p class="mb-2">(855) 937-2396</p>
                    <p class="mb-2">support@tripleuprealestate.com</p>
                    <div class="d-flex pt-2">&nbsp;</div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <a class="btn btn-link text-white-50" href="about.php">About Us</a>
                    <a class="btn btn-link text-white-50" href="contact.html">Contact Us</a>
                    <a class="btn btn-link text-white-50" href="privacy.html">Privacy Policy</a>
                    <a class="btn btn-link text-white-50" href="terms.html">Terms &amp; Condition</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">&copy; <a class="border-bottom" href="#">Triple Up Real Estate</a>, All Right Reserved. 2024</div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="index.php">Home</a>
                            <a href="cookies.html">Cookies</a>
                            <a href="help.html">Help</a>
                            <a href="faq.html">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>