<?php
    session_start();

    include('config.php');

    $quote_id = key($_POST);

    // Delete specified quote from table
    $sql = "DELETE FROM Quote WHERE quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($quote_id));

    /*$sql = "SELECT * FROM Quote_Item;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($rows);*/

    // Redirect to quote page
    header("Location: hq.php");
?>