<?php
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

// Handle form submission for updating credits
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_credits'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $new_credits = filter_input(INPUT_POST, 'new_credits', FILTER_VALIDATE_INT);
    
    if ($new_credits !== false && $new_credits >= 0) {
        $stmt = $conn->prepare("UPDATE users SET down_payment_credits = ? WHERE first_name = ? AND last_name = ? AND email = ?");
        $stmt->bind_param("isss", $new_credits, $first_name, $last_name, $email);
        
        if ($stmt->execute()) {
            $message = "Credits updated successfully for " . htmlspecialchars("$first_name $last_name");
            $message_class = 'success';
        } else {
            $message = "Error updating credits: " . $conn->error;
            $message_class = 'error';
        }
        $stmt->close();
    } else {
        $message = "Invalid credit value. Please enter a non-negative integer.";
        $message_class = 'error';
    }
}

// Fetch all users
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$query = "SELECT first_name, last_name, email, phone, zip_code, down_payment_credits FROM users";
if ($search) {
    $query .= " WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%'";
}
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage User Credits - Triple Up Real Estate</title>
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
            color: var(--dark);
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
        .content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: var(--primary);
            color: white;
        }
        tr:hover {
            background-color: var(--light);
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
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
        #editForm {
            background-color: var(--light);
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        #searchForm {
            margin-bottom: 20px;
        }
        .btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #009d7e;
        }
        .btn-edit {
            background-color: var(--secondary);
        }
        .btn-edit:hover {
            background-color: #e55b1e;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Triple Up Real Estate - Admin Panel</h1>
        </div>
    </header>

    <div class="container">
        <div class="content">
            <h2>Manage User Credits</h2>
            
            <?php if ($message): ?>
                <div class="message <?php echo $message_class; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form id="searchForm" method="get">
                <input type="text" name="search" placeholder="Search by name or email" value="<?php echo htmlspecialchars($search); ?>">
                <input type="submit" value="Search">
            </form>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Zip Code</th>
                    <th>Down Payment Credits</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['zip_code']); ?></td>
                    <td><?php echo $row['down_payment_credits']; ?></td>
                    <td>
                        <button class="btn btn-edit" onclick="selectUser('<?php echo addslashes($row['first_name']); ?>', '<?php echo addslashes($row['last_name']); ?>', '<?php echo addslashes($row['email']); ?>', '<?php echo addslashes($row['phone']); ?>', '<?php echo addslashes($row['zip_code']); ?>', <?php echo $row['down_payment_credits']; ?>)">Edit</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>

            <div id="editForm" style="display:none;">
                <h3>Edit User Credits</h3>
                <form method="post">
                    <input type="hidden" id="firstName" name="first_name">
                    <input type="hidden" id="lastName" name="last_name">
                    <input type="hidden" id="email" name="email">
                    <p>Name: <span id="fullName"></span></p>
                    <p>Email: <span id="userEmail"></span></p>
                    <p>Phone: <span id="userPhone"></span></p>
                    <p>Zip Code: <span id="userZipCode"></span></p>
                    <label for="newCredits">Down Payment Credits:</label>
                    <input type="number" id="newCredits" name="new_credits" min="0" required>
                    <input type="submit" name="update_credits" value="Update Credits">
                </form>
            </div>
        </div>
    </div>

    <script>
        function selectUser(firstName, lastName, email, phone, zipCode, credits) {
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('firstName').value = firstName;
            document.getElementById('lastName').value = lastName;
            document.getElementById('email').value = email;
            document.getElementById('fullName').textContent = firstName + ' ' + lastName;
            document.getElementById('userEmail').textContent = email;
            document.getElementById('userPhone').textContent = phone;
            document.getElementById('userZipCode').textContent = zipCode;
            document.getElementById('newCredits').value = credits;
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>