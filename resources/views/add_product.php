<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Product</title>
</head>
<body>
    <h2>Add New Product</h2>
    <form action="process_add_product.php" method="post">
        <label>Barcode:</label><br>
        <input type="text" name="barcode" required><br>
        <label>Product Name:</label><br>
        <input type="text" name="name" required><br>
        <label>Import Price:</label><br>
        <input type="number" name="import_price" required><br>
        <label>Retail Price:</label><br>
        <input type="number" name="retail_price" required><br>
        <label>Category:</label><br>
        <input type="text" name="category" required><br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>
