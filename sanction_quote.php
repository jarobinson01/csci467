<?php
    session_start();
    
    include('config.php');

    $sql = "UPDATE Quote SET status='Sanctioned' WHERE item_id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('id' => $_SESSION['ITEM_ID']));

    header("Location: hq.php");
?>