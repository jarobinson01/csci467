<?php
    session_start();
    
    include('config.php');
    include('process_order.php');

    echo "<h3>Email for Quote #".$_SESSION['QUOTE_ID']." sent</h3><br>";

    // Update quote to ordered
    $sql = "UPDATE Quote SET status='Ordered' WHERE quote_id=:id;";
    $prepared = $db1->prepare($sql);
    $prepared->execute(array('id' => $_SESSION['QUOTE_ID']));

    // Send order to external processing system
    $sql = "SELECT * FROM Quote WHERE quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));
    $quote = $prepared->fetch();

    process_order($_SESSION['QUOTE_ID'], $quote['customer'], $quote['price']);

    // Send email with quote details
    // The message
    $msg = "QUOTE #".$_SESSION['QUOTE_ID']."    \n";
    
    $sql = "SELECT * FROM Quote_Item WHERE foreign_quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));
    $items = $prepared->fetchAll(PDO::FETCH_ASSOC);

    foreach($items as $item) {
        $sql = "SELECT * FROM Item WHERE item_id = ?;";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute(array($item['foreign_item_id']));
        $i = $prepared->fetch();

        $msg .= " - ".$i['item_name']."\n";
    }

    $msg .= "\n\n ---- Price (with discounts applied): $".$quote['price'];

    echo $msg;

    // Use wordwrap() if lines are longer than 100 characters
    $msg = wordwrap($msg,100);

    // Send email
    mail($quote['customerEmail'],"Your quote has been completed",$msg);

    // Redirect to hq page
    echo '<hr>';
    echo '<form action="hq.php">';
    echo '<input type="submit" value="Back to HQ">';
    echo '</form>';
?>