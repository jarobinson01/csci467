<?php
    session_start();
    
    include('config.php');

    $keys = array_keys($_POST);
    $_SESSION["QUOTE_ID"] = $keys[2];

    $item_id = key($_POST);
    print_r($_POST);
    echo "<br>";
    echo $_SESSION["QUOTE_ID"];

    /*$sql = "UPDATE Item SET name=";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $item_id = $prepared->fetch();*/
?>