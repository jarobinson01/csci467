<?php
    session_start();

    include('config.php');

    echo $_POST['price']."<br>";
    echo number_format($quote['price'], 2, '.', '');

    // Get current id value for the Item that will be added
    $sql = "SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = 'z1923374'
            AND   TABLE_NAME   = 'Item';";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $item_id = $prepared->fetch();

    // Insert row into Item table
    $sql = "INSERT INTO Item (price, item_name) VALUES (?, ?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_POST['price'], $_POST['name']));

    // Insert row into Quote_Item table
    $sql = "INSERT INTO Quote_Item (foreign_quote_id, foreign_item_id) VALUES (?, ?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID'], $item_id[0]));

    // Update quote price based on price of added item
    $sql = "SELECT * FROM Quote WHERE quote_id=?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));
    $quote = $prepared->fetch();

    $price = $quote['price'];
    $price = $price + $_POST['price'];

    $sql = "UPDATE Quote SET price=:price WHERE quote_id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('price' => $price, 'id' => $_SESSION['QUOTE_ID']));

    // Redirect to quote page
    //header("Location: quote.php");
?>