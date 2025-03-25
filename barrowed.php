<?php
session_start();
include './db_connect.php'; // Ensure the database connection is included

if (!isset($_SESSION['username'])) {
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}

// Fetch borrowed books for the user
$sql = "SELECT books.title, books.author, issued_books.issue_date, issued_books.due_date, issued_books.status 
        FROM issued_books 
        JOIN books ON issued_books.book_id = books.book_id 
        WHERE issued_books.username = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

$stmt->close();
$conn->close();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Borrowed Books</title>
    <link rel="stylesheet" href="./css/barrow.css" />
</head>
<body>
    <header>
        <div class="logo">
            <img src="./source/images.png" alt="College Logo" />
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
            <?php echo isset($_SESSION['username']) ? strtoupper($_SESSION['username'][0]) : 'A'; ?>
        </div>
    </header>

    <div class="container">
        <h2>Borrowed Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Issue Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="borrowed-books">
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['issue_date']); ?></td>
                        <td><?php echo htmlspecialchars($book['due_date']); ?></td>
                        <td><?php echo htmlspecialchars($book['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2025 College Library. All Rights Reserved.</p>
    </footer>
</body>
</html>