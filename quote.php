<?php
    include('config.php');
    echo '<form action=hq.php method=POST><button>BACK</button></form>';

    $sql = "SELECT * FROM Quote_Item";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    $r = 0;
    echo '<h1>Quote #'.$rows[0]['quote_id'].'</h1>';
    foreach($rows as $row){
        $sql = "SELECT * FROM Quote WHERE id = ".$row['item_id'].";";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute();
        $lineItem = $prepared->fetchALL();
        $text = implode(" ", $lineItem);
        //$price = $lineItem[0]['price'];
        echo $text;
        echo '<tr>';
        echo '<td> ---  Item ID: '.$row['item_id'].'</td>';
        echo '<td> ---  Quantity: '.$row['quantity'].'</td>';
        echo '</tr>';
        echo ' ---- ';
        echo '<button onClick="document.location.href=\'quote.php\'">Edit</button>';
        echo '<button>Delete</button>';
        echo '</br>';
    }

    echo '<button><a href="logout.php">Logout</a></button>';
?>