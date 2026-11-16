<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    hello!! these are the links to the pages.<br>
    <ul>
        <li><a href="viewProducts.php">View Products</a><br></li>
        <li><a href="addProduct.php">Add Product</a><br></li>
        <li><a href="updateproduct.php?id=<?php echo $record['id']; ?>">Update Product</a></li>
    </ul>
</body>
</html>