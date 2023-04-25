<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Item</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    form {
      width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    input[type=text] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    input[type=submit] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type=submit]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <?php
    // Connect to MySQL database
    include 'db_connect.php';

    // Retrieve item details
    $itemname = $_GET['itemname'];
    $sql = "SELECT * FROM groceryitems WHERE itemname='$itemname'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Update item details
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $itemname = $_POST['itemname'];
      $itemtype = $_POST['itemtype'];
      $priceperunit = $_POST['priceperunit'];
      $quantityavailable = $_POST['quantityavailable'];
      $sql = "UPDATE groceryitems SET itemtype='$itemtype', priceperunit='$priceperunit', quantityavailable='$quantityavailable' WHERE itemname='$itemname'";
      mysqli_query($conn, $sql);

      // redirect to table.php
      header("Location: table.php");
    }

    // Display form to update item details
    include "components/header.php";
    echo "<form method='POST'>";
    echo "<label for='itemname'>Item Name:</label>";
    echo "<input type='text' name='itemname' value='" . $row['itemname'] . "' readonly><br>";
    echo "<label for='itemtype'>Item Type:</label>";
    echo "<input type='text' name='itemtype' value='" . $row['itemtype'] . "'><br>";
    echo "<label for='priceperunit'>Price per Unit:</label>";
    echo "<input type='text' name='priceperunit' value='" . $row['priceperunit'] . "'><br>";
    echo "<label for='quantityavailable'>Quantity Available:</label>";
    echo "<input type='text' name='quantityavailable' value='" . $row['quantityavailable'] . "'><br>";
    echo "<input type='submit' value='Update'>";
    echo "</form>";
    include "components/footer.php";
  ?>
</body>
</html>
