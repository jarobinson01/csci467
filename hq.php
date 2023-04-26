<?php
    include('config.php');
    echo '<h1>HQ</h1>';

    $sql = "SELECT * FROM Quote;";// WHERE status = 'Finalized';";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    //$total = 0;
    foreach($rows as $row) {
        /*global $total;
        $sql = "SELECT * FROM Quote_Item WHERE foreign_quote_id = ".$row['quote_id'].";";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute();
        $quote_items = $prepared->fetchAll(PDO::FETCH_ASSOC);
        foreach($quote_items as $quote_item) {
            $sql = "SELECT * FROM Item WHERE item_id = ".$quote_item['foreign_item_id'].";";
            $prepared = $db1->prepare($sql);
            $success = $prepared->execute();
            $items = $prepared->fetchAll(PDO::FETCH_ASSOC);
            foreach($items as $item)
                $total += $item['price'];
        }
        //print_r($items);

        $sql = "UPDATE Quote SET price=:price WHERE quote_id=:id;";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute(array('price' => $total, 'id' => $row['quote_id']));*/

        echo '<tr>';
        echo '<td>'.$row['quote_id'].'</td>';
        echo '<td> -    Cutsomter '.$row['customer'].'</td>';
        echo '<td> ---  Price: $'.$row['price'].'</td>';
        echo '<td> ---  Customer Email: '.$row['customerEmail'].'</td>';
        echo '<td> ---  Quote Status: '.$row['status'].'</td>';
        echo '</tr>';
        echo ' ---- ';
        echo '<form action=select_quote.php method=POST style="display: inline;">';
        echo '<input type="submit" name="'.$row['quote_id'].'" value="Sanction Quote">';
        echo '</form>';
        echo '<form action="delete_quote.php" method="POST" style="display: inline;">';
        echo '<input type="submit" name="'.$row['quote_id'].'" value="Delete Quote">';
        echo '</form>';
        echo '</br>';

        $total = 0;
    }

    echo '<button><a href="logout.php">Logout</a></button>';
?>