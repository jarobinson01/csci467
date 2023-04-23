<?php
    echo '<h1>HQ</h1>';

    $sql = "SELECT * FROM Quote";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        echo '<tr>';
        echo '<td>'.$row['id'].'</td>';
        echo '<td> -    '.$row['customer'].'</td>';
        echo '<td> ---  Commission: $'.$row['price'].'</td>';
        echo '<td> ---  Customer Email: $'.$row['customerEmail'].'</td>';
        echo '<td> ---  Quote Status: $'.$row['status'].'</td>';
        echo '</tr>';
        echo ' ---- ';
        echo '<button>Edit</button>';
        echo '<button>Delete</button>';
        echo '</br>';
    }

    echo '<button><a href="logout.php">Logout</a></button>';
?>