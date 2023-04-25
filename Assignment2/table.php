<!DOCTYPE html>
<html>

<head>
    <title>Web Programming: Server Side Assignment Part 2</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>

<?php

// connect to database
include 'db_connect.php';

// Retrieve data from groceryitems table
$limit = 5; // Number of items to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$start = ($page - 1) * $limit; // Starting index for the current page

// Sorting options
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'itemname';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

$sql = "SELECT * FROM groceryitems ORDER BY $sort $order LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

include('components/header.php');

// Display data in HTML table
echo "<table>";
echo "<tr><th><a href='?sort=itemname&order=" . ($sort == 'itemname' && $order == 'asc' ? 'desc' : 'asc') . "'>Item Name</a></th>";
echo "<th><a href='?sort=itemtype&order=" . ($sort == 'itemtype' && $order == 'asc' ? 'desc' : 'asc') . "'>Item Type</a></th>";
echo "<th><a href='?sort=priceperunit&order=" . ($sort == 'priceperunit' && $order == 'asc' ? 'desc' : 'asc') . "'>Price per Unit</a></th>";
echo "<th><a href='?sort=quantityavailable&order=" . ($sort == 'quantityavailable' && $order == 'asc' ? 'desc' : 'asc') . "'>Quantity Available</a></th>";
echo "<th>Actions</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['itemname'] . "</td>";
    echo "<td>" . $row['itemtype'] . "</td>";
    echo "<td>" . $row['priceperunit'] . "</td>";
    echo "<td>" . $row['quantityavailable'] . "</td>";
    echo "<td><a href='edit_item.php?itemname=" . $row['itemname'] . "'>Edit</a> | <a href='delete_item.php?itemname=" . $row['itemname'] . "'>Delete</a></td>";
    echo "</tr>";
}
echo "</table>";

// Display pagination links
$sql = "SELECT COUNT(*) as count FROM groceryitems";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total = $row['count'];
$pages = ceil($total / $limit);
echo "<p>";
if ($page > 1) {
    echo "<a href='?page=" . ($page - 1) . "&sort=$sort&order=$order'>Previous</a> ";
}
for ($i = 1; $i <= $pages; $i++) {
    echo "<a href='?page=$i&sort=$sort&order=$order'>". $i . "</a> ";
}
if ($page < $pages) {
echo "<a href='?page=" . ($page + 1) . "&sort=$sort&order=$order'>Next</a> ";
}
echo "</p>";

include('components/footer.php');

// Close database connection
mysqli_close($conn);
?>

</html>