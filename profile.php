<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "mani";
$password = "Mani789@axl";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$userData = [];

// Fetch user data
$sql = "SELECT name, email FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $updateSql = "UPDATE users SET name = ?, email = ? WHERE username = ?";
    $updateStmt->bind_param("sss", $name, $email, $username);
    

    if ($updateStmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="./css/profile.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="./source/images.png" alt="College Logo">
            <h1>AMC ENGINEERING COLLEGE</h1>
        </div>
        <nav>
        <ul>
            <li><a href="stufacdash.php">Home</a></li>
            <li><a href="search.php">Search Books</a></li>
            <li><a href="barrowed.php">Borrowed Books</a></li>
            <li><a href="return.php">Return Books</a></li>
            <li><a href="issue.php">Issue Requests</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        </nav>
        <div class="user-logo" id="user-logo">
            <?php echo strtoupper($username[0]); ?>
        </div>
    </header>
    
    <div class="container">
        <h2>Profile</h2>
        <form id="profileForm" method="POST">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($userData['name']); ?>" readonly>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" readonly>

           

            <button type="button" id="editBtn">Edit Profile</button>
            <button type="submit" id="saveBtn" style="display:none;">Save Changes</button>
        </form>
    </div>
    
    <footer>
        <p>&copy; 2025 College Library. All Rights Reserved.</p>
    </footer>

    <script>
        document.getElementById('editBtn').addEventListener('click', function () {
            document.querySelectorAll('#profileForm input').forEach(input => input.removeAttribute('readonly'));
            document.getElementById('saveBtn').style.display = 'inline-block';
            document.getElementById('editBtn').style.display = 'none';
        });
    </script>
</body>
</html>
