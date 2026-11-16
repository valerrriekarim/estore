<?php
    require_once("dbInfo.php");

    $mysqli = new mysqli($hostname,$dbUser,$dbPassword,$db);
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

    <?php

        $sqlStatement = "INSERT into products …";
        $mysqli->query($sqlStatement);

    ?>
    
    </body>
</html>