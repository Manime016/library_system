<?php
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

// Handle delete request
if (isset($_GET['action']) && isset($_GET['request_id'])) {
    $requestId = intval($_GET['request_id']);
    $sql = "DELETE FROM reports_requests WHERE request_id = $requestId";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Request deleted successfully'); window.location.href='issue_requests.php';</script>";
        exit;
    } else {
        echo "Error deleting request: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports and Requests - AMC ENGINEERING COLLEGE</title>
    <link rel="stylesheet" href="css/admindash.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="source/images.png" alt="College Logo" class="college-logo">
            <div class="user-logo" id="user-logo">A</div>
        </div>
        <h1>Reports and Requests - AMC ENGINEERING COLLEGE</h1>
    </header>

    <nav>
        <ul>
            <li><a href="admin.php">Home</a></li>
            <li><a href="manage_books.php">Manage Books</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="#">Reports and Requests</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <main>
        <h2>Reports and Requests</h2>

        <!-- Faculty Requests Section -->
        <section class="dashboard-section">
            <h3>Faculty Requests</h3>
            <table>
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Faculty Username</th>
                        <th>Request Type</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM reports_requests WHERE user_type = 'faculty'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['request_id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['request_type']}</td>
                                <td>{$row['details']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <button onclick='deleteRequest({$row['request_id']})'>Delete</button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Student Reports Section -->
        <section class="dashboard-section">
            <h3>Student Reports</h3>
            <table>
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Student Username</th>
                        <th>Request Type</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM reports_requests WHERE user_type = 'student'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['request_id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['request_type']}</td>
                                <td>{$row['details']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <button onclick='deleteRequest({$row['request_id']})'>Delete</button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 College Library. All Rights Reserved.</p>
    </footer>

    <script>
        function deleteRequest(requestId) {
            if (confirm('Are you sure you want to delete this request?')) {
                window.location.href = `issue_requests.php?action=delete_request&request_id=${requestId}`;
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
