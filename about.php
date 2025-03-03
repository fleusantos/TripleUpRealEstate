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
    <title>About Triple Up Real Estate</title>
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
                <a class="nav-item nav-link active" href="about.php">About</a>
                <a class="nav-item nav-link" href="investors.php">Investors</a>
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
                <h1 class="display-5 animated fadeIn mb-4">About Our Program</h1>
                <p>We are setting the new standard for affordable housing with a win/win program that can only be described as brilliant. Renters can now afford to own their own home with less hassle and less cost than renting. Investors hold 32.5% more equity than their investment which makes an incredible 12% consistantly. Sellers get no hassle cash sales for their property. This isn't just a win for all, this is a huge win for all.</p>
            </div>
            <div class="col-md-6 animated fadeIn"><img class="img-fluid" src="img/header.jpg" alt="" /></div>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0"><img class="img-fluid w-100" src="img/about.jpg" alt="" /></div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-4">Great for Investing in Real Estate</h1>
                    <p class="mb-4">Investors funds are backed by 32.5% more equity than their investment.</p>
                    <p>For a $100,000 property, investors would only need to invest $68,500 and would receive $1000 every month.</p>
                    <p>Our program turns over property very fast so investors recieve 1% on their investment every month and select to re-up, receiving 1% per month indefinitly, or receive thier principle back.</p>
                   
                    <p>Investors can pull their money out at the conclusion of each acquisition.</p>
                    <a class="btn btn-primary py-3 px-5 mt-3" href="investors.php">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Call to Action Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded p-3">
                <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3);">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s"><img class="img-fluid rounded w-100" src="img/call-to-action.jpg" alt="" /></div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="mb-4">
                                <h1 class="mb-3">True Affordable Housing</h1>
                                <p>Buyers pay the taxes, insurance, and principal payments only with the minimum payment equal to 1/360th of the total price. This is the equilvalent of 30 years same as cash. For a $100,000 home, the monthly cost including taxes and insurance would not exceed $534 per month.</p>
                            </div>
                            <a class="btn btn-dark py-3 px-4" href="buyers.php">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" style="max-width: 600px;" data-wow-delay="0.1s">
                <h1 class="mb-3">Sellers</h1>
                <p>Our program only works if the selling price is at or below the appraised market value. If the selling price is at or below the appraised market value, we will be willing to pay the full asking price.</p>
                <br /> <a class="btn btn-primary py-3 px-5 mt-3" href="sellers.php">Read More</a>
            </div>
            <div class="row g-4">&nbsp;</div>
        </div>
    </div>
    <!-- Team End -->

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
                    <a class="btn btn-link text-white-50" href="contact.php">Contact Us</a>
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
                            <a href="faq.html">FAQ</a>
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