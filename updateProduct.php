
<?php
    require_once("dbInfo.php");

    $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    // Get product ID from URL
    $id = $_GET["id"];

    // If form is submitted, update the product
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $sqlStatement = "UPDATE products SET name='$name', price=$price, quantity=$quantity WHERE id=$id";
        $mysqli->query($sqlStatement);

        // Redirect to home page
        header("Location: index.html");
        exit();
    }

    // Get existing product details
    $sqlStatement = "SELECT * FROM products WHERE id=$id";
    $result = $mysqli->query($sqlStatement);
    $record = $result->fetch_assoc();

    if (!$record) {
        echo "Product not found!";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>

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
            border-color: #2196F3;
        }

        input[type="submit"] {
            width: 100%;
            padding: 11px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1976D2;
        }

        a {
            display: block;
            text-align: center;
            color: #2196F3;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Update Product</h2>

        <form name="productForm" action="updateproduct.php?id=<?php echo $id; ?>" method="POST" onsubmit="return validateForm()">

            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name"
                    value="<?php echo htmlspecialchars($record['name']); ?>"
                    placeholder="Enter product name">
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01"
                    value="<?php echo htmlspecialchars($record['price']); ?>"
                    placeholder="Enter price">
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity"
                    value="<?php echo htmlspecialchars($record['quantity']); ?>"
                    placeholder="Enter quantity">
            </div>

            <input type="submit" value="Update Product">

        </form>

        <br>
        <a href="index.html">Back to home</a>
    </div>

    <script>
        function validateForm() {
            var name = document.getElementById("name").value.trim();
            var price = document.getElementById("price").value.trim();
            var quantity = document.getElementById("quantity").value.trim();

            if (name === "" || price === "" || quantity === "") {
                alert("Please fill up all required fields!");
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
