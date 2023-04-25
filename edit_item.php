<?php
    session_start();
    
    include('config.php');

    $keys = array_keys($_POST);
    $_SESSION["QUOTE_ID"] = $keys[2];
    $item_id = key($_POST);

    $sql = "UPDATE Item SET name='".$_POST['name']."' WHERE id=".$item_id.";";
    //$sql = "UPDATE Item SET name='Desk' WHERE id=1";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    /*$sql = "UPDATE Item SET price=".$_POST['price']." WHERE id=".$item_id.";";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();*/

    $sql = "SELECT * FROM Item;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($rows);
?>