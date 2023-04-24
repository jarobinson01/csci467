<?php
    include('config.php');

    $sql = "INSERT INTO Item (price) VALUES ('".$_POST['price']."');";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $sql = "INSERT INTO Quote_Item (quote_id, item_id, price) VALUES (2, '".$_POST['item_id']."', '".$_POST['price']."');";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    print_r($success);

    //header("Location: quote.php");
?>