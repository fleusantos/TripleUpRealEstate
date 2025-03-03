<?php
session_start();
$servername = "yahripley.startlogicmysql.com";
$username = "tripleup";
$password = "111"; // Remember to keep this secure in a production environment
$dbname = "tripleup";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
$message_class = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $zip_code = $_POST['zip_code'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = 'user'; // Set default role to 'user'

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, zip_code, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone, $zip_code, $password, $role);

    // Execute the statement
    if ($stmt->execute()) {
        $message = "Registration successful!";
        $message_class = 'success';
        
        // Set session variables
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $role;
        
        // Redirect to index.php after successful registration
        header("Location: index.php");
        exit();
    } else {
        $message = "Error: " . $stmt->error;
        $message_class = 'error';
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - Triple Up Real Estate</title>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary: #00B98E;
        --secondary: #FF6922;
        --light: #EFFDF5;
        --dark: #0E2E50;
    }
    body { 
        font-family: 'Heebo', sans-serif; 
        background-color: var(--light);
        margin: 0;
        padding: 0;
    }
    .container { 
        max-width: 1140px; 
        margin: 0 auto; 
        padding: 20px;
    }
    .header {
        background-color: white;
        padding: 20px 0;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .header h1 {
        color: var(--primary);
        margin: 0;
        font-family: 'Inter', sans-serif;
    }
    .form-container {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        margin-top: 30px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        color: var(--dark);
    }
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }
    input[type="submit"] {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #009d7e;
    }
    .message {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .success {
        background-color: #d4edda;
        color: #155724;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Triple Up Real Estate</h1>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <h2>Registration Form</h2>
            
            <?php if ($message): ?>
                <div class="message <?php echo $message_class; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone (optional):</label>
                    <input type="tel" id="phone" name="phone">
                </div>

                <div class="form-group">
                    <label for="zip_code">Zip Code:</label>
                    <input type="text" id="zip_code" name="zip_code" required>
                </div>

                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</body>
</html>