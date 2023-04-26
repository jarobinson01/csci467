<?php
    include('config.php');
    echo '<h1>HQ</h1>';

    // Print finalized quotes
    $sql = "SELECT * FROM Quote WHERE status = 'Finalized' OR status = 'Sanctioned';";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    foreach($rows as $row) {
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
    }

    echo '<button><a href="logout.php">Logout</a></button>';
?>