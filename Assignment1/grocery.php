<!DOCTYPE html>
<html>

<head>
    <title>Insert Grocery Item</title>
</head>

<?php

// connect to database
include 'db_connect.php';

// Get input data from the form
$itemname = $_POST['itemname'];
$itemtype = $_POST['itemtype'];
$itemdescription = $_POST['itemdescription'];
$priceperunit = $_POST['priceperunit'];
$quantityavailable = $_POST['quantityavailable'];

// Validate input data
if (!is_numeric($priceperunit) || !is_numeric($quantityavailable)) {
    echo "<p>Price per unit and quantity available must be numeric.</p>";
} else {
    // Prepare SQL statement
    $sql = "INSERT INTO groceryitems (itemname, itemtype, itemdescription, priceperunit, quantityavailable) VALUES ('$itemname', '$itemtype', '$itemdescription', $priceperunit, $quantityavailable)";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "<p>New record created successfully.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<body>
    <h1>Insert Grocery Item</h1>
    <form action="grocery.php" method="post">
        Item Name: <input type="text" name="itemname" required><br><br>
        Item Type:
        <input type="radio" name="itemtype" value="fruit" <?php if($itemtype=="fruit") echo "checked" ?> required>
        Fruit
        <input type="radio" name="itemtype" value="vegetable" <?php if($itemtype=="vegetable") echo "checked" ?>
        required> Vegetable
        <input type="radio" name="itemtype" value="pantry" <?php if($itemtype=="pantry") echo "checked" ?> required>
        Pantry
        <input type="radio" name="itemtype" value="meat" <?php if($itemtype=="meat") echo "checked" ?> required> Meat
        <input type="radio" name="itemtype" value="dairy" <?php if($itemtype=="dairy") echo "checked" ?> required>
        Dairy
        <br><br>
        Item Description: <textarea name="itemdescription" rows="5" cols="30" required></textarea><br><br>
        Price per Unit: <input type="number" step="0.01" name="priceperunit" required><br><br>
        Quantity Available: <input type="number" name="quantityavailable" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>