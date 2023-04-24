<?php
    include('config.php');

    $sql = "INSERT INTO Item (price) VALUES ('".$_POST['price']."');";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $sql = "INSERT INTO Quote_Item (quote_id, item_id, price) VALUES ('".$QUOTE_ID."', '".$_POST['item_id']."', '".$_POST['price']."');";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    header("Location: quote.php");
?>