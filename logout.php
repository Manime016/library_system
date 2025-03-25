<?php
session_start(); // Start or resume the session

// Destroy all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: index.html");
exit();
?>