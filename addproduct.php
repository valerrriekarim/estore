<?php
    require_once("dbInfo.php");

    $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    // 1. If form was submitted, insert into database and redirect to index.html
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $sqlStatement = "INSERT into products (name, price, quantity) VALUES ('$name', $price, $quantity)";
        $mysqli->query($sqlStatement);

        // Redirect user to home page (index.html) upon successful add
        header("Location: index.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>

    <div class="form-container">
        <h2>Add New Product</h2>
        
        <!-- Form submits to addproduct.php itself -->
        <form name="productForm" action="addproduct.php" method="POST" onsubmit="return validateForm()">
          
          <!-- 1. Product Name -->
          <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter product name">
          </div>
          
          <!-- 2. Price -->
          <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" placeholder="Enter price">
          </div>
          
          <!-- 3. Quantity -->
          <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" placeholder="Enter quantity">
          </div>
          
          <input type="submit" value="Add Product">
        </form>
        <br>
        <a href="viewProducts.php">View All Products</a>
    </div>

    <!-- JavaScript Validation: checks fields are filled before submitting -->
    <script>
        function validateForm() {
            var name = document.getElementById("name").value.trim();
            var price = document.getElementById("price").value.trim();
            var quantity = document.getElementById("quantity").value.trim();

            if (name === "" || price === "" || quantity === "") {
                alert("Please fill up all required fields (Name, Price, and Quantity)!");
                return false; // Blocks submission
            }
            return true; // Allows submission
        }
    </script>
    
</body>
</html>