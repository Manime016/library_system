<?php
session_start();

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

// Function to handle user login
function loginUser ($conn) {
    $user = mysqli_real_escape_string($conn, $_POST['USER']);
    $pass = mysqli_real_escape_string($conn, $_POST['PASSWORD']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    // Validate login type
    if (!in_array($type, ['faculty', 'student'])) {
        echo "<script>alert('Invalid login type.'); window.location.href='login.html';</script>";
        exit();
    }

    // Query for user authentication
    $sql = "SELECT * FROM users WHERE username = '$user' AND user_type = '$type'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $user;
            $_SESSION['user_type'] = $type;

            // Redirect based on user type
            header('Location: stufacdash.html');
            exit();
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href='login.html?type=$type';</script>";
        }
    } else {
        echo "<script>alert('Invalid username or login type.'); window.location.href='login.html?type=$type';</script>";
    }
}

// Function to handle user registration
function registerUser ($conn) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $user_type = trim($_POST['user_type']);

    // Validate passwords
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.location.href='register.html';</script>";
        exit();
    }

    // Check if username already exists
    $check_sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists. Please choose a different one.'); window.location.href='register.html';</script>";
        exit();
    }

    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into users table
    $sql = "INSERT INTO users (first_name, last_name, username, password, user_type) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $first_name, $last_name, $username, $hashed_password, $user_type);

    if ($stmt->execute()) {
        echo "<script>alert('User  registered successfully!'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='register.html';</script>";
    }

    $stmt->close();
}

// Function to fetch user details
function fetchUser Details($conn) {
    if (!isset($_SESSION['username'])) {
        echo json_encode(['error' => 'User  not logged in']);
        exit();
    }

    $user = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    $userDetails = $result->fetch_assoc();
    echo json_encode($userDetails);

    $stmt->close();
}

// Handle different operations based on the request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'login':
                loginUser ($conn);
                break;
            case 'register':
                registerUser ($conn);
                break;
       