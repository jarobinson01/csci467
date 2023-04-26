<?php
    session_start();
    
    include('config.php');

    $sql = "UPDATE Quote SET status='Sanctioned' WHERE quote_id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('id' => $_SESSION['QUOTE_ID']));

    header("Location: hq.php");
?>