<?php 
session_start();

$servername = "localhost";
$username = "";
$password = "";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Book
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $author_id = $_POST['author_id'];
    $publisher = $_POST['publisher'];
    $publisher_id = $_POST['publisher_id'];
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO books (title, author, author_id, publisher, publisher_id, isbn, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssi", $title, $author, $author_id, $publisher, $publisher_id, $isbn, $quantity);

    if ($stmt->execute()) {
        echo "<script>alert('Book added successfully!'); window.location.href='bookmanage.php';</script>";
    } else {
        echo "<script>alert('Error adding book: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Fetch Books
$result = $conn->query("SELECT * FROM books");
$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Books - AMC ENGINEERING COLLEGE</title>
    <link rel="stylesheet" href="css/admindash.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #007bff;
            color: white;
            padding: 15px;
            border-radius: 5px;
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        .college-logo {
            height: 50px;
            margin-right: 10px;
        }
        .user-logo {
            width: 40px;
            height: 40px;
            background: white;
            color: #007bff;
            font-weight: bold;
            font-size: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            background: #007bff;
            border-radius: 5px;
            overflow: hidden;
        }
        nav ul li {
            margin: 0;
            padding: 10px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .form-container {
            margin-bottom: 20px;
            background: #e8f0fe;
            padding: 15px;
            border-radius: 8px;
        }
        .form-container form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .form-container input {
            padding: 10px;
            width: 95%;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            grid-column: span 2;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container button:hover {
            background: #0056b3;
        }
        .search-bar {
            margin-bottom: 15px;
            text-align: center;
        }
        .search-bar input {
            width: 60%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .table-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background: #007bff;
            color: white;
            position: sticky;
            top: 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tbody tr:hover {
            background: #f1f1f1;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="source/images.png" alt="College Logo" class="college-logo" />
            <div class="user-logo" id="user-logo">
                <?php echo isset($_SESSION['username']) ? strtoupper($_SESSION['username'][0]) : 'A'; ?>
            </div>
        </div>
        <h1>Manage Books - AMC ENGINEERING COLLEGE</h1>
    </header>

    <nav>
        <ul>
            <li><a href="admin.php">Home</a></li>
            <li><a href="bookmanage.php">Manage Books</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="issue_requests.php">Report Requests</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <!-- Add Book Form -->
        <div class="form-container">
            <h3>Add a New Book</h3>
            <form action="bookmanage.php" method="post">
                <input type="text" name="title" placeholder="Title" required />
                <input type="text" name="author" placeholder="Author" required />
                <input type="text" name="author_id" placeholder="Author ID" required />
                <input type="text" name="publisher" placeholder="Publisher" required />
                <input type="text" name="publisher_id" placeholder="Publisher ID" required />
                <input type="text" name="isbn" placeholder="ISBN" required />
                <input type="number" name="quantity" placeholder="Quantity" required />
                <button type="submit">Add Book</button>
            </form>
        </div>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search for books..." onkeyup="searchBooks()">
        </div>

        <!-- Book List -->
        <div class="table-container">
            <table id="booksTable">
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Author ID</th>
                        <th>Publisher</th>
                        <th>Publisher ID</th>
                        <th>ISBN</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?php echo $book['book_id']; ?></td>
                            <td><?php echo $book['title']; ?></td>
                            <td><?php echo $book['author']; ?></td>
                            <td><?php echo $book['author_id']; ?></td>
                            <td><?php echo $book['publisher']; ?></td>
                            <td><?php echo $book['publisher_id']; ?></td>
                            <td><?php echo $book['isbn']; ?></td>
                            <td><?php echo $book['quantity']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
