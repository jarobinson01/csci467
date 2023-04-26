<?php
    session_start();

    include('config.php');

    $discount = (float)$_POST['discount'];

    $sql = "SELECT * FROM Quote WHERE quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));
    $quote = $prepared->fetch();

    $price = $quote['price'];

    echo $_POST['discount']."<br>";
    echo $price."<br>";

    echo $_POST['discount_type']."<br>";

    if($_POST['discount_type'] = "percentage") {
        $price = $price * (100 - $_POST['discount']) / 100;
    } else {
        $price = $price - $_POST['discount'];
    }

    echo $price."<br>";

    $sql = "UPDATE Quote SET price=:price WHERE quote_id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('price' => $price, 'id' => $_SESSION['QUOTE_ID']));

    //header("Location: quote.php");
?>