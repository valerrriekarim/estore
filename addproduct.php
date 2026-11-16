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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 350px;
            margin: 80px auto;
            padding: 25px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        input[type="submit"] {
            width: 100%;
            padding: 11px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
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
        <a href="index.html">Back to home</a>
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