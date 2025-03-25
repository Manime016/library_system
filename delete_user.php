<?php
include 'db.php';

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        echo "User  deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>