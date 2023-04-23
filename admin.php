<?php

    echo "<form action=\"?\" method=\"POST\">";               //form for submitting necessary information from the customer to process the orders
        echo 'Administrator:';
        echo "<input type=\"submit\" name=\"associate\" value=\"Associates\">";
        echo "<input type=\"submit\" name=\"customer\" value=\"Customers\">";
        echo '<button><a href="logout.php">Logout</a></button>';
        echo "<input type=\"hidden\" name=\"name\" value =\"".$name."\">";
        echo "<input type=\"hidden\" name=\"password\" value =\"".$password."\">";
    echo "</form>";

    //VIEW/EDIT/DELETE ASSOCIATES
    if (isset($_POST['associate'])){  
        echo "Sales Associates </br>";
        echo "_______________________________________________________________________________________";
        echo '</br></br>';

        //VIEW ALL ASSOCIATES, GIVE OPTIONS
        $sql = "SELECT * FROM User WHERE is_associate = 1;";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute();

        $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
        foreach($rows as $row){
            echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td> -    '.$row['name'].'</td>';
            echo '<td> ---  Commission: $'.$row['commission'].'</td>';
            echo '</tr>';
            echo ' ---- ';
            echo '<button>Edit</button>';
            echo '<button>Delete</button>';
            echo '</br>';
        }

        echo '_______________________________________________________________________________________';

        //GIVE CREATE ASSOCIATE OPTION
        echo '<p>Create a new Sales Associate</p>';
        echo "<form action=\"?\" method=\"POST\">";
        //NAME
        echo '<label for="name">Name:</label>';
        echo '<input type="text" id="name" name="name">';
        echo '</br>';
        //PASSWORD
        echo '<label for="password">Password:</label>';
        echo '<input type="text" id="password" name="password">';
        echo '</br>';
        //COMMISSION
        echo '<label for="commission">Commission:</label>';
        echo '<input type="text" id="commission" name="commission">';
        echo '</br>';
        //ADDRESS
        echo '<label for="address">Address:</label>';
        echo '<input type="text" id="address" name="address">';
        echo '</br>';

        echo '<input type="submit" value="Create">';
        echo '</form>';

    }   
    if (isset($_POST['customer'])){  
        echo "<h4>Customers</h4>";

        $sql = "SELECT * FROM customers;";
        $prepared = $db2->prepare($sql);
        $success = $prepared->execute();

        $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
        foreach($rows as $row){
            echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td> - '.$row['name'].'</td>';
            echo '<td> - '.$row['city'].'</td>';
            echo '<td> - '.$row['street'].'</td>';
            echo '<td> - '.$row['contact'].'</td>';
            echo '</tr>';
            echo '</br>';
        }
    } 
?>