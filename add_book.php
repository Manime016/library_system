<?php
// add_book.php - Handles adding a new book to the database
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $author_id = $_POST['author_id'];
    $publisher = $_POST['publisher'];
    $publisher_id = $_POST['publisher_id'];
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO books (title, author, author_id, publisher, publisher_id, isbn, quantity, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssisssi', $title, $author, $author_id, $publisher, $publisher_id, $isbn, $quantity);

    if ($stmt->execute()) {
        echo "Book added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php
// fetch_books.php - Fetches all books from the database as JSON
include 'db.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

header('Content-Type: application/json');
echo json_encode($books);
$conn->close();
?>

<?php
// delete_book.php - Deletes a book by book_id
include 'db.php';

if (isset($_GET['book_id'])) {
    $book_id = intval($_GET['book_id']);
    $sql = "DELETE FROM books WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $book_id);

    if ($stmt->execute()) {
        echo "Book deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php
// db.php - Database connection file
$servername = "localhost";
$username = "";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
