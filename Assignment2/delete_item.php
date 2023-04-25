<?php
// Connect to MySQL database
include 'db_connect.php';

// Delete item
$itemname = $_GET['itemname'];
$sql = "DELETE FROM groceryitems WHERE itemname='$itemname'";
mysqli_query($conn, $sql);

// Redirect to index page
header("Location: table.php");
?>
