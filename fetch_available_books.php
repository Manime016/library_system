<?php
// Database connection details
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

// Fetch available books
$sql = "SELECT title, author, publisher FROM books";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['title']) . "</td>
                <td>" . htmlspecialchars($row['author']) . "</td>
                <td>" . htmlspecialchars($row['publisher']) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No available books found.</td></tr>";
}

// Close the database connection
$conn->close();
?>