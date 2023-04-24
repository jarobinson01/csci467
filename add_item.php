<?php
    include('config.php');

    $sql = "INSERT INTO Item (price, name) VALUES (?, ?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_POST['price'], $_POST['name']));

    $sql = "SELECT * FROM Item;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($rows);

    $sql = "SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = 'z1923374'
            AND   TABLE_NAME   = 'Item';";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $rows = $prepared->fetch();
    echo "<br>";
    print_r($rows[0]);

    $sql = "INSERT INTO Quote_Item (quote_id, item_id) VALUES (?, ?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_POST['quote_id'], $_POST['item_id']));

    $sql = "SELECT * FROM Quote_Item;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($rows);

    //header("Location: quote.php");
?>