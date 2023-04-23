<?php
    include('config.php');
    echo '<form action=hq.php method=POST><button>BACK</button></form>';

    $sql = "SELECT * FROM Quote_Item";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    echo '<h1>Quote #'.$rows[0]['quote_id'].'</h1>';
    foreach($rows as $row){
        echo '<tr>';
        echo '<td> ---  Item ID: '.$row['price'].'</td>';
        echo '<td> ---  Quantity: '.$row['quantity'].'</td>';
        echo '</tr>';
        echo ' ---- ';
        echo '<button onClick="document.location.href=\'quote.php\'">Edit</button>';
        echo '<button>Delete</button>';
        echo '</br>';
    }

    echo '<button><a href="logout.php">Logout</a></button>';
?>