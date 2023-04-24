<?php
    include('config.php');
    echo "Hello";

    $sql = "INSERT INTO Item (price) VALUES (?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_POST['price']));

    $i = $_POST['item_id'];

    $sql = "INSERT INTO Quote_Item (quote_id, item_id, price) VALUES (?, ?, ?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array(2, $_POST['item_id'], $_POST['price']));
    //print_r($prepared);

    //header("Location: quote.php");
?>