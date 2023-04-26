<?php
    session_start();
    
    include('config.php');

    $keys = array_keys($_POST);
    $_SESSION['ITEM_ID'] = $keys[2];

    // Update item name
    $sql = "UPDATE Item SET item_name=:item_name WHERE item_id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('item_name' => $_POST['name'], 'id' => $_SESSION['ITEM_ID']));

    // Update item price
    $sql = "UPDATE Item SET price=:price WHERE item_id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('price' => $_POST['price'], 'id' => $_SESSION['ITEM_ID']));

    // Update quote price
    $sql = "SELECT * FROM Quote WHERE quote_id=?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));
    $quote = $prepared->fetch();

    $price = $quote['price'];
    $price = $price + $_POST['price'];

    $sql = "UPDATE Quote SET price=:price WHERE quote_id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('price' => $price, 'id' => $_SESSION['QUOTE_ID']));

    // Redirect to quote page
    header("Location: quote.php");
?>