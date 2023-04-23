<?php
    include('config.php');
    echo '<h1>Quotes</h1>';

    $sql = "SELECT * FROM Quote";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        echo '<tr>';
        echo '<td>'.$row['id'].'</td>';
        echo '<td> -    Cutsomter '.$row['customer'].'</td>';
        echo '<td> ---  Commission: $'.$row['price'].'</td>';
        echo '<td> ---  Customer Email: '.$row['customerEmail'].'</td>';
        echo '<td> ---  Quote Status: '.$row['status'].'</td>';
        echo '</tr>';
        echo ' ---- ';
        echo '<button onClick="document.location.href=\'quote.php\'">Edit</button>';
        echo '<button>Delete</button>';
        echo '</br>';
    }

    echo '<button><a href="logout.php">Logout</a></button>';
?>