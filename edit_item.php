<?php
    session_start();
    
    include('config.php');

    $item_id = key($_POST);
    print_r($_POST);

    /*$sql = "UPDATE Item SET name=";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $item_id = $prepared->fetch();*/
?>