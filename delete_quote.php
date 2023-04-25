<?php
    session_start();

    include('config.php');

    $quote_id = key($_POST);

    $sql = "DELETE FROM Create_Quote WHERE foreign_quote_id = ?";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($quote_id));

    $sql = "DELETE FROM Quote_Note WHERE foreign_quote_id = ?";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($quote_id));

    $sql = "DELETE FROM Quote_Item WHERE foreign_quote_id = ?";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($quote_id));

    // Delete specified quote from table
    $sql = "DELETE FROM Quote WHERE quote_id = ?";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($quote_id));

    if($success) {
        echo "Success";
    } else {
        echo "Fail";
    }

    $sql = "SELECT * FROM Quote;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($rows);

    // Redirect to quote page
    //header("Location: hq.php");
?>