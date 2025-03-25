<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - AMC ENGINEERING COLLEGE</title>
    <link rel="stylesheet" href="css/admindash.css" />
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="source/images.png" alt="College Logo" class="college-logo" />
            <div class="user-logo" id="user-logo">
                <?php echo isset($_SESSION['username']) ? strtoupper($_SESSION['username'][0]) : 'A'; ?>
            </div>
        </div>
        <h1>Admin Dashboard - AMC ENGINEERING COLLEGE</h1>
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

    <main>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></h2>
        <p>Manage the library efficiently with the options available in the navigation menu.</p>

        <section class="dashboard-section">
            <h3>Quick Stats</h3>
            <?php
            // Database connection details
            $servername = "localhost";
            $username = "mani";
            $password = "Mani789@axl";
            $dbname = "library";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                echo "<p>Error connecting to database: " . $conn->connect_error . "</p>";
            } else {
                // Fetch total books
                $totalBooksQuery = "SELECT COUNT(*) AS total_books FROM books";
                $totalBooksResult = $conn->query($totalBooksQuery);
                $totalBooks = ($totalBooksResult->num_rows > 0) ? $totalBooksResult->fetch_assoc()['total_books'] : 0;

                // Fetch total users
                $totalUsersQuery = "SELECT COUNT(*) AS total_users FROM users";
                $totalUsersResult = $conn->query($totalUsersQuery);
                $totalUsers = ($totalUsersResult->num_rows > 0) ? $totalUsersResult->fetch_assoc()['total_users'] : 0;

                // Fetch pending report requests
                $pendingRequestsQuery = "SELECT COUNT(*) AS pending_requests FROM reports_requests WHERE status = 'Pending'";
                $pendingRequestsResult = $conn->query($pendingRequestsQuery);
                $pendingRequests = ($pendingRequestsResult->num_rows > 0) ? $pendingRequestsResult->fetch_assoc()['pending_requests'] : 0;

                echo "<p>Total Books: <span id='total-books'>$totalBooks</span></p>";
                echo "<p>Total Users: <span id='total-users'>$totalUsers</span></p>";
                echo "<p>Pending Report Requests: <span id='pending-requests'>$pendingRequests</span></p>";
            }

            $conn->close();
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 College Library. All Rights Reserved.</p>
    </footer>
</body>
</html>
