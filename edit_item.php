<?php
    session_start();
    
    include('config.php');

    $_SESSION["QUOTE_ID"] = key($_POST[2]);

    $item_id = key($_POST);
    print_r($_POST);
    echo "<br>";

    /*$sql = "UPDATE Item SET name=";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $item_id = $prepared->fetch();*/
?>