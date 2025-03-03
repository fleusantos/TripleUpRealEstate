<?php
session_start();
$servername = "yahripley.startlogicmysql.com";
$username = "tripleup";
$password = "111"; // Remember to keep this secure in a production environment
$dbname = "tripleup";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
$message_class = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role']; // Store the user's role in the session
            header("Location: index.php");
            exit();
        } else {
            $message = "Login failed. Invalid email or password.";
            $message_class = 'error';
        }
    } else {
        $message = "Login failed. Invalid email or password.";
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
    <title>Login - Triple Up Real Estate</title>
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
            <h2>Login</h2>
            
            <?php if ($message): ?>
                <div class="message <?php echo $message_class; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>