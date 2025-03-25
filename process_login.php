<?php
session_start();

$servername = "localhost";
$username = "";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = mysqli_real_escape_string($conn, $_POST['USER']);
    $pass = mysqli_real_escape_string($conn, $_POST['PASSWORD']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    if (!in_array($type, ['admin', 'faculty', 'student'])) {
        echo "<script>alert('Invalid login type.'); window.location.href='login.html';</script>";
        exit();
    }

    // SQL Query for Authentication
    $sql = "SELECT * FROM users WHERE username = '$user' AND role = '$type'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Password verification without hashing
        if ($pass === $row['password']) {
            $_SESSION['username'] = $user;
            $_SESSION['role'] = $type;
            $_SESSION['user_id'] = $row['user_id'];

            // Redirect Based on User Type
            if ($type === 'admin') {
                header('Location: admin.php');
            } else {
                header('Location: stufacdash.php');
            }
            exit();
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href='login.html?type=$type';</script>";
        }
    } else {
        echo "<script>alert('Invalid username or login type.'); window.location.href='login.html?type=$type';</script>";
    }
}

$conn->close();
?>
