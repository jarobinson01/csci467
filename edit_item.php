<?php
    session_start();
    
    include('config.php');

    $keys = array_keys($_POST);
    $_SESSION['ITEM_ID'] = $keys[2];

    $sql = "UPDATE Item SET name=:name WHERE id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('name' => $_POST['name'], 'id' => $_SESSION['ITEM_ID']));

    $sql = "UPDATE Item SET price=:price WHERE id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('price' => $_POST['price'], 'id' => $_SESSION['ITEM_ID']));

    header("Location: quote.php");
?>