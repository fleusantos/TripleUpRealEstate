<?php
session_start();

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_email']) && !empty($_SESSION['user_email']);
$isAdmin = $isLoggedIn && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';

// Database connection
$servername = "yahripley.startlogicmysql.com";
$username = "tripleup";
$password = "111"; // Remember to keep this secure in a production environment
$dbname = "tripleup";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userCredits = 0;

if ($isLoggedIn) {
    $userEmail = $_SESSION['user_email'];
    $stmt = $conn->prepare("SELECT down_payment_credits FROM users WHERE email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $userCredits = $row['down_payment_credits'];
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Buyers</title>
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
	<link href="css/affd.css" rel="stylesheet">
    <style>
      .mt-50 {
        margin-top: 50px;
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
                    <a class="nav-item nav-link" href="investors.php">Investors</a>
                    <a class="nav-item nav-link active" href="buyers.php">Buyers</a>
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
                    <h1 class="display-5 animated fadeIn mb-4 mt-50">Affordable Housing</h1>
                    <nav>
                        <p>Pay taxes, insurance, and principal payments only.</p>
                        <p>Qualifying is easier than qualifying to rent.</p>
                        <p>Just acquire enough Down Payment Credits to pay 10%<br>
						And you qualify.  No credit check, no income verification</p>
                    </nav>
                    <?php if ($isLoggedIn): ?>
                        <div class="mt-4 p-3 bg-light rounded">
                            <h3>Your Down Payment Credits</h3>
                            <p>Current Balance: $<?php echo number_format($userCredits, 2); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 animated fadeIn"><img class="img-fluid" src="img/header.jpg" alt="" /></div>
            </div>
        </div>
        <!-- Header End -->

    <!-- Property List Start -->
    <div class="container-xxl py-5" align="center">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">How to acquire Down Payment Credits</h1>
                        <p>You can acquire all the downpayment credits you need for free.  
							There are several options and more being added constantly.</p>
						   <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s"><a class="btn btn-primary py-3 px-5" href="dpcredits.html">Free Down Payments</a></div>
                    </div>
                </div>
            </div>
			
			
			<div class="calculator-container">
        <h1>Affordable Housing Program</h1>

        <!-- Section 1: Calculate Monthly Payment -->
        <section id="monthly-payment-calculator">
            <h2>Calculate Your Monthly Payment</h2>
            <p>Enter the value of a home to calculate your monthly payment:</p>
            <input type="number" id="homeValue" placeholder="Enter Home Value (USD)" />
            <button onclick="calculateMonthlyPayment()">Calculate</button>
            <p id="monthlyPaymentResult" class="result"></p>
        </section>

        <!-- Section 2: Calculate Home Value -->
        <section id="home-value-calculator">
            <h2>Find Out How Much Home You Can Afford</h2>
            <p>Enter your monthly budget to calculate the home value you can afford:</p>
            <input type="number" id="monthlyBudget" placeholder="Enter Monthly Budget (USD)" />
            <button onclick="calculateHomeValue()">Calculate</button>
            <p id="homeValueResult" class="result"></p>
        </section>
    </div>

    <script>
        // Function to calculate monthly payment
        function calculateMonthlyPayment() {
            const homeValue = parseFloat(document.getElementById("homeValue").value);
            if (isNaN(homeValue) || homeValue <= 0) {
                document.getElementById("monthlyPaymentResult").textContent = "Please enter a valid home value.";
                return;
            }
            const insurance = (homeValue / 100000) * 35;
            const taxes = (homeValue * 0.02) / 12;
            const principal = homeValue / 360;
            const monthlyPayment = insurance + taxes + principal;
            document.getElementById("monthlyPaymentResult").textContent = `Estimated Monthly Payment: $${monthlyPayment.toFixed(2)}`;
        }

        // Function to calculate home value
        function calculateHomeValue() {
            const monthlyBudget = parseFloat(document.getElementById("monthlyBudget").value);
            if (isNaN(monthlyBudget) || monthlyBudget <= 0) {
                document.getElementById("homeValueResult").textContent = "Please enter a valid monthly budget.";
                return;
            }
            let estimatedHomeValue = 0;
            for (let i = 1; i < 1e7; i++) { // Increment to refine the estimate
                const insurance = (i / 100000) * 35;
                const taxes = (i * 0.02) / 12;
                const principal = i / 360;
                const monthlyPayment = insurance + taxes + principal;
                if (monthlyPayment > monthlyBudget) break;
                estimatedHomeValue = i;
            }
            document.getElementById("homeValueResult").textContent = `You can afford a home valued at: $${estimatedHomeValue}`;
        }
    </script>
			
			
          <br><br><br>  <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden"><a><img class="img-fluid" src="img/property-1.jpg" alt="" /></a>
                                    <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Example</div>
                                    <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">$380,000 Home</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                            <h6>This home sells for $380,000</h6>
                            <p>To purchase this home through Triple Up Real Estate, you would need 10% down and your minimum payments would be $1766 per month.</p>
                            <p>Want to know how to get the 10% down payment without money?</p>
                        </div>
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s"><a class="btn btn-primary py-3 px-5" href="dpcredits.html">Get Down Payments</a></div>
                    </div>
                </div>
                <!-- Other tab content remains the same -->
            </div>
        </div>
    </div>
    <!-- Property List End -->

    <!-- Call to Action Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded p-3">
                <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3);">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s"><img class="img-fluid rounded w-100" src="img/call-to-action.jpg" alt="" /></div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="mb-4">
                                <h1 class="mb-3">Contact Our Real Estate Agent</h1>
                                <!-- Calendly inline widget begin -->
                                <div class="calendly-inline-widget" style="min-width: 320px; height: 700px;" data-url="https://calendly.com/360win/triple-up-real-estate">&nbsp;</div>
                                <script src="https://assets.calendly.com/assets/external/widget.js" async="" type="text/javascript"></script>
                                <!-- Calendly inline widget end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->

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