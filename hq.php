<?php
    include('config.php');
    echo '<h1>HQ</h1>';

    $sql = "SELECT * FROM Quote WHERE status = 'F'";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        echo '<tr>';
        echo '<td>'.$row['id'].'</td>';
        echo '<td> -    Cutsomter '.$row['customer'].'</td>';
        echo '<td> ---  Price: $'.$row['price'].'</td>';
        echo '<td> ---  Customer Email: '.$row['customerEmail'].'</td>';
        echo '<td> ---  Quote Status: '.$row['status'].'</td>';
        echo '</tr>';
        echo ' ---- ';
        echo '<form action=quote.php method=POST style="display: inline;"><button>Sanction Quote</button></form>';
        echo '<button>Delete Quote</button>';
        echo '</br>';
    }

    echo '<button><a href="logout.php">Logout</a></button>';
?>