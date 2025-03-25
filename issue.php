<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$servername = "localhost";
$username = "mani";
$password = "Mani789@axl";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $issueType = $_POST['issue-type'];
    $description = $conn->real_escape_string($_POST['description']);
    $username = $_SESSION['username'];

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO reports_requests (username, user_type, request_type, details, status) VALUES (?, 'student', ?, ?, 'Pending')");
    $stmt->bind_param("sss", $username, $issueType, $description);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Issue submitted successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Error submitting issue: " . $stmt->error;
        $_SESSION['msg_type'] = "error";
    }
    $stmt->close();
    $conn->close();

    // Redirect back to the same page
    header("Location: issue.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Issues</title>
    <link rel="stylesheet" href="./css/issue.css">
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
                <li><a href="borrowed.php">Borrowed Books</a></li>
                <li><a href="return.php">Return Books</a></li>
                <li><a href="issue.php">Issue Requests</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="user-logo" id="user-logo">
            <?php echo strtoupper($_SESSION['username'][0]); ?>
        </div>
    </header>

    <div class="container">
        <h2>Library Issues</h2>
        <p>Please fill out the form below for any book requests, feedback, or issues regarding the library.</p>

        <!-- Display messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert <?php echo $_SESSION['msg_type']; ?>">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']); 
                    unset($_SESSION['msg_type']);
                ?>
            </div>
        <?php endif; ?>

        <form action="issue.php" method="POST">
            <label for="issue-type">Issue Type:</label>
            <select id="issue-type" name="issue-type" required>
                <option value="request">Request for a Book</option>
                <option value="feedback">Library Feedback</option>
                <option value="problem">Report an Issue</option>
            </select>

            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="Enter your issue details..." rows="5" required></textarea>

            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 College Library. All Rights Reserved.</p>
    </footer>
</body>
</html>
