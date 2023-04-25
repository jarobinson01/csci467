<?php
    session_start();
    
    include('config.php');

    $keys = array_keys($_POST);
    $_SESSION['ITEM_ID'] = $keys[0];
    //$item_id = key($_POST);

    $sql = 'UPDATE Item SET name=:name WHERE id=:id;';
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('name' => $_POST['name'], 'id' => $_SESSION['ITEM_ID']));
    echo $_SESSION['ITEM_ID'];

    /*$sql = "UPDATE Item SET name='?' WHERE id=?;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array($_POST['name'], $item_id));*/

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