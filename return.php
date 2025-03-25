<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('User not logged in'); window.location.href='login.php';</script>";
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

$username = $_SESSION['username'];

// **Clear Dues**
if (isset($_POST['clear_dues']) && isset($_POST['selected_books'])) {
    $selected_books = $_POST['selected_books'];
    $payment_method = $_POST['payment_method'];
    $today = date("Y-m-d");

    foreach ($selected_books as $borrow_id) {
        // Get due date
        $stmt = $conn->prepare("SELECT due_date FROM borrowed_books WHERE borrow_id = ?");
        $stmt->bind_param("i", $borrow_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $due_date = $row['due_date'];
            $days_overdue = max(0, (strtotime($today) - strtotime($due_date)) / (60 * 60 * 24));
            $fine = $days_overdue * 5; // ₹5 per day

            // **Show Payment Confirmation**
            echo "<script>
                if (confirm('Fine: ₹$fine. Pay via $payment_method?')) {
                    window.location.href='return.php';
                }
            </script>";

            // **Update due date to today**
            $update_stmt = $conn->prepare("UPDATE borrowed_books SET due_date = ? WHERE borrow_id = ?");
            $update_stmt->bind_param("si", $today, $borrow_id);
            $update_stmt->execute();
        }
    }
}

// **Return Books**
if (isset($_POST['return_books']) && isset($_POST['selected_books'])) {
    $selected_books = $_POST['selected_books'];
    $today = date("Y-m-d");

    foreach ($selected_books as $borrow_id) {
        // Check if book is overdue
        $stmt = $conn->prepare("SELECT due_date FROM borrowed_books WHERE borrow_id = ?");
        $stmt->bind_param("i", $borrow_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $due_date = $row['due_date'];
            if ($due_date && $due_date < $today) {
                echo "<script>alert('Cannot return overdue book! Clear dues first.');</script>";
            } else {
                // Remove book from borrowed_books table
                $delete_stmt = $conn->prepare("DELETE FROM borrowed_books WHERE borrow_id = ?");
                $delete_stmt->bind_param("i", $borrow_id);
                $delete_stmt->execute();
                echo "<script>alert('Book returned successfully.');</script>";
            }
        }
    }
}

// Fetch borrowed books
$sql = "SELECT borrow_id, book_name, publisher, due_date FROM borrowed_books WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Books</title>
    <link rel="stylesheet" href="./css/return.css">
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
        <h2>Return Books</h2>
        <form action="return.php" method="post">
            <table id="tb1">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Book Name</th>
                        <th>Publisher</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><input type="checkbox" name="selected_books[]" value="<?php echo $row['borrow_id']; ?>"></td>
                            <td><?php echo htmlspecialchars($row['book_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['publisher']); ?></td>
                            <td><?php echo $row['due_date'] ? htmlspecialchars($row['due_date']) : 'No Dues'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <div class="button-container">
                <select name="payment_method" required>
                    <option value="">Select Payment Method</option>
                    <option value="Card">Card</option>
                    <option value="Cash">Cash</option>
                </select>
                <button type="submit" name="clear_dues" class="button-clear">Clear Dues</button>
                <button type="submit" name="return_books" class="button-return">Return</button>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 College Library. All Rights Reserved.</p>
    </footer>

    <script>
        document.querySelector("form").addEventListener("submit", function (event) {
            let checkboxes = document.querySelectorAll("input[name='selected_books[]']:checked");
            if (checkboxes.length === 0) {
                alert("Please select at least one book.");
                event.preventDefault();
            }
        });
    </script>
</body>
</html>

<?php $stmt->close(); $conn->close(); ?>
