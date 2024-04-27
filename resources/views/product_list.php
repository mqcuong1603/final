<?php
session_start();
// Check if admin or salesperson is logged in
if(!isset($_SESSION['admin']) && !isset($_SESSION['salesperson'])) {
    header("Location: index.php");
    exit();
}

// Product list query and display
$products = []; // Fetch products from database or any storage
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
    <h2>Product List</h2>
    <table border="1">
        <tr>
            <th>Barcode</th>
            <th>Product Name</th>
            <th>Import Price</th>
            <?php if(isset($_SESSION['admin'])): ?>
                <th>Retail Price</th>
                <th>Category</th>
                <th>Creation Date</th>
                <th>Action</th>
            <?php endif; ?>
        </tr>
        <?php foreach($products as $product): ?>
            <tr>
                <td><?= $product['barcode'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['import_price'] ?></td>
                <?php if(isset($_SESSION['admin'])): ?>
                    <td><?= $product['retail_price'] ?></td>
                    <td><?= $product['category'] ?></td>
                    <td><?= $product['creation_date'] ?></td>
                    <td>
                        <a href="update_product.php?id=<?= $product['id'] ?>">Update</a>
                        <?php if($product['in_order'] == 0): ?>
                            <a href="delete_product.php?id=<?= $product['id'] ?>">Delete</a>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
