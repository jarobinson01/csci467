<?php
    include('config.php');

    // Get current id value for the Item that will be added
    $sql = "SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = 'z1923374'
            AND   TABLE_NAME   = 'Item';";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $item_id = $prepared->fetch();

    // Insert row into Item table
    $sql = "INSERT INTO Item (price, name) VALUES (?, ?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_POST['price'], $_POST['name']));

    // Insert row into Quote_Item table
    $sql = "INSERT INTO Quote_Item (quote_id, item_id, quantity) VALUES (?, ?, ?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID'], $item_id[0], 1));

    /*$sql = "SELECT * FROM Quote_Item;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($rows);*/

    // Redirect to quote page
    header("Location: quote.php");
?>