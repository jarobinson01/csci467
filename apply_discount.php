<?php
    session_start();

    include('config.php');

    $discount = (float)$_POST['discount'];

    // Select current quote
    $sql = "SELECT * FROM Quote WHERE quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));
    $quote = $prepared->fetch();

    // Calculate discount
    $price = $quote['price'];

    if($_POST['discount_type'] == "percentage") {
        $price = $price * (100 - $_POST['discount']) / 100;
    } else {
        $price = $price - $_POST['discount'];
    }

    // Apply discount to database
    $sql = "UPDATE Quote SET price=:price WHERE quote_id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('price' => $price, 'id' => $_SESSION['QUOTE_ID']));

    // Redirect to quote page
    header("Location: quote.php");
?>