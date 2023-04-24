<?php
    include('config.php');
    echo "Hello";

    $sql = "INSERT INTO Item (price, name) VALUES (?, ?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_POST['price'], $_POST['name']));

    $sql = "SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = 'z1923374'
            AND   TABLE_NAME   = 'Item';";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    print_r($rows);

    //$sql = "INSERT INTO Quote_Item (quote_id) VALUES (?, ?, ?);";
    //$prepared = $db1->prepare($sql);
    //$success = $prepared->execute(array($_POST['quote_id'], $_POST['price'], $_POST['name']));

    $sql = "SELECT * FROM Quote_Item;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    print_r($rows);
    //print_r($prepared);

    //header("Location: quote.php");
?>