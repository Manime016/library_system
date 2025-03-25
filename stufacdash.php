<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/facdash.css">
    <style>
        .scrollable-table {
            width: 100%;
            height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="source/images.png" alt="College Logo" class="college-logo">
            <div class="user-logo" id="user-logo">
                <?php echo isset($_SESSION['username']) ? strtoupper($_SESSION['username'][0]) : 'A'; ?>
            </div>
            <h1>AMC ENGINEERING COLLEGE</h1>
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
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></h2>
        
        <!-- Available Books Section -->
        <section class="dashboard-section">
            <h3>Available Books</h3>
            <div class="scrollable-table">
                <table>
                    <thead>
                        <tr>
                            <th>Book Name</th>
                            <th>Author Name</th>
                            <th>Publisher Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'fetch_available_books.php'; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Borrowed Books Section -->
        <section class="dashboard-section">
            <h3>Borrowed Books</h3>
            <div class="borrowed-books" id="borrowed-books">
                <?php include 'fetch_borrowed_books.php'; ?>
            </div>
        </section>
    </main>
<br><br><br>
    <footer>
        <p>&copy; 2025 College Library. All Rights Reserved.</p>
    </footer>
</body>
</html>