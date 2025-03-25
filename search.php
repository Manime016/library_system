<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please log in first!'); window.location.href='login.php';</script>";
    exit;
}

$servername = "localhost";
$username = "";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Issue Book Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['issueBook'])) {
    $bookId = $_POST['selected_book'];
    $username = $_SESSION['username'];
    $issueDate = date('Y-m-d');
    $dueDate = date('Y-m-d', strtotime('+7 days'));

    $sql = "INSERT INTO issued_books (book_id, username, issue_date, due_date, status) VALUES (?, ?, ?, ?, 'Issued')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $bookId, $username, $issueDate, $dueDate);

    if ($stmt->execute()) {
        echo "<script>alert('Book issued successfully! Collect it from the library.'); window.location.href='search.html';</script>";
    } else {
        echo "Error issuing book: " . $stmt->error;
    }
    $stmt->close();
}

// HTML Content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books - AMC ENGINEERING COLLEGE</title>
    <link rel="stylesheet" href="./css/search.css" />
</head>
<body>
    <header>
        <div class="header-left">
            <img src="source/images.png" alt="College Logo" class="college-logo" />
        </div>
        <h1>AMC ENGINEERING COLLEGE</h1>
        <div class="user-logo" id="user-logo">
            <?php echo strtoupper($_SESSION['username'][0]); ?>
        </div>
    </header>

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

    <main>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p><strong>"A library is not a luxury but one of the necessities of life." – Henry Ward Beecher 📚✨</strong></p>

        <section class="dashboard-section">
            <h3>Search for Books</h3>
            <form method="POST" action="">
                <input type="text" name="query" id="search-box" placeholder="Enter book title or author..." required />
                <button type="submit" name="search">Search</button>
            </form>

            <?php
            // Perform search if search button is clicked
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
                $search = $conn->real_escape_string($_POST['query']);
                $sql = "SELECT book_id, title, author, publisher FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<form method="POST" action="">';
                    echo '<table><thead><tr><th>Select</th><th>Book Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td><input type="radio" name="selected_book" value="' . $row['book_id'] . '" required /></td>
                                <td>' . $row['title'] . '</td>
                                <td>' . $row['author'] . '</td>
                                <td>' . $row['publisher'] . '</td>
                              </tr>';
                    }
                    echo '</tbody></table>';
                    echo '<button type="submit" name="issueBook">Issue Book</button>';
                    echo '</form>';
                } else {
                    echo '<p>No books found.</p>';
                }
            }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 College Library. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
