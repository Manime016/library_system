<?php
session_start();

$servername = "localhost";
$username = "mani";
$password = "Mani789@axl";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add User
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, role, username, password, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $name, $email, $role, $username, $password);

    if ($stmt->execute()) {
        echo "User added successfully.";
    } else {
        echo "Error adding user: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch Users
if (isset($_GET['action']) && $_GET['action'] === 'fetch_users') {
    $result = $conn->query("SELECT user_id, name, email, role, username, created_at FROM users");
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
    exit;
}

// Delete User
if (isset($_GET['action']) && $_GET['action'] === 'delete_user' && isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $stmt->error;
    }
    $stmt->close();
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Users - AMC ENGINEERING COLLEGE</title>
    <link rel="stylesheet" href="css/admindash.css" />
    <style>
        .table-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #0073e6;
            color: white;
        }
        #searchBar {
            margin-top: 10px;
            padding: 8px;
            width: 100%;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="source/images.png" alt="College Logo" class="college-logo" />
            <div class="user-logo" id="user-logo">A</div>
        </div>
        <h1>Manage Users - AMC ENGINEERING COLLEGE</h1>
    </header>

    <nav>
        <ul>
            <li><a href="admin.php">Home</a></li>
            <li><a href="bookmanage.php">Manage Books</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="issue_requests.php">Issue Requests</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <main>
        <h2>Manage Users</h2>
        <section class="dashboard-section">
            <h3>Add a New User</h3>
            <form action="manage_users.php" method="post">
                <label>Name: <input type="text" name="name" required /></label>
                <label>Email: <input type="email" name="email" required /></label>
                <label>Role:
                    <select name="role" required>
                        <option value="student">Student</option>
                        <option value="faculty">Faculty</option>
                        <option value="admin">Admin</option>
                    </select>
                </label>
                <label>Username: <input type="text" name="username" required /></label>
                <label>Password: <input type="password" name="password" required /></label>
                <button type="submit">Add User</button>
            </form>
        </section>

        <section class="dashboard-section">
            <h3>Search Users</h3>
            <input type="text" id="searchBar" placeholder="Search by Name, Email, or Role..." onkeyup="filterUsers()" />

            <h3>User List</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Username</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="user-list"></tbody>
                </table>
            </div>
        </section>
    </main>
<br><br><br>
    <footer>
        <p>&copy; 2025 College Library. All Rights Reserved.</p>
    </footer>

    <script>
        async function loadUsers() {
            try {
                const response = await fetch('manage_users.php?action=fetch_users');
                const users = await response.json();
                const userList = document.getElementById('user-list');
                userList.innerHTML = '';

                users.forEach(user => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${user.user_id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.role}</td>
                        <td>${user.username}</td>
                        <td>${user.created_at}</td>
                        <td>
                            <button onclick="deleteUser(${user.user_id})">Delete</button>
                        </td>
                    `;
                    userList.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading users:', error);
            }
        }

        async function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                await fetch(`manage_users.php?action=delete_user&user_id=${userId}`);
                loadUsers();
            }
        }

        function filterUsers() {
            const searchValue = document.getElementById('searchBar').value.toLowerCase();
            const rows = document.querySelectorAll("#user-list tr");

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(searchValue) ? "" : "none";
            });
        }

        document.addEventListener('DOMContentLoaded', loadUsers);
    </script>
</body>
</html>
