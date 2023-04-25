<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Display welcome message
echo "<h1>Welcome, " . htmlspecialchars($_SESSION["username"]) . "!</h1>";

// Link to change password page
echo "<p><a href='change_password.php'>Change Password</a></p>";

// Link to logout page
echo "<p><a href='logout.php'>Logout</a></p>";
?>
