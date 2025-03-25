<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
} else {
    echo "Database Connected Successfully!";
}
?>
