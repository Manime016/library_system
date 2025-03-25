<?php
// Remove or comment out this line
// session_start(); 

$servername = "localhost";
$username = "";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT books.title, books.author, issued_books.issue_date, issued_books.due_date, issued_books.status
                        FROM issued_books
                        JOIN books ON issued_books.book_id = books.book_id
                        WHERE issued_books.username = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$row['title']} by {$row['author']} - Status: {$row['status']}</li>";
    }
    echo "</ul>";
} else {
    echo "No borrowed books found.";
}
$stmt->close();
$conn->close();
?>
