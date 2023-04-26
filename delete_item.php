<?php
    session_start();

    include('config.php');

    $item_id = key($_POST);

    // Insert row into Quote_Item table
    $sql = "DELETE FROM Quote_Item WHERE foreign_item_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($item_id));

    // Insert row into Item table
    $sql = "DELETE FROM Item WHERE item_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($item_id));

    // Redirect to quote page
    header("Location: quote.php");
?>