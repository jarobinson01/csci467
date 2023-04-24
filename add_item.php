<?php
    include('config.php');
    print_r($_POST);

    $sql = "INSERT INTO Item (price) VALUES ('".$_POST['price']."');";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $sql = "INSERT INTO Quote_Item (quote_id, price) VALUES ('".$_POST['quote_id']."', '".$_POST['item_id']."', '".$_POST['price']."');";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    header("Location: quote.php");
?>