
<?php
    require_once("dbInfo.php");

    $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $sqlStatement = "SELECT * FROM products";
    $result = $mysqli->query($sqlStatement);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 60px auto;
            padding: 25px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .update {
            color: #2196F3;
            text-decoration: none;
        }

        .delete {
            color: red;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Product List</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>

            <?php
                while ($record = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($record["id"]); ?></td>

                    <td><?php echo htmlspecialchars($record["name"]); ?></td>

                    <td><?php echo htmlspecialchars($record["price"]); ?></td>

                    <td><?php echo htmlspecialchars($record["quantity"]); ?></td>

                    <td>
                        <a class="update" href="updateproduct.php?id=<?php echo $record['id']; ?>">
                            Update
                        </a>
                    </td>
                </tr>
            <?php
                }

                $result->free_result();
                $mysqli->close();
            ?>

        </table>

        <a class="back" href="index.html">Back to Home</a>
    </div>

</body>
</html>
