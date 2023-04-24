<html>
    <script>
        function showAddItem() {
        var x = document.getElementById("addItem");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
        }
    </script>
</html>

<?php
    include('config.php');

    $sql = "SELECT * FROM Quote_Item";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    $total = 0;
    echo '<h1>Quote #'.$rows[0]['quote_id'].'</h1>';
    echo '<form action=hq.php method=POST><button>BACK</button></form>';
    foreach($rows as $row){
        $sql = "SELECT * FROM Item WHERE id = ".$row['item_id'].";";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute();
        $lineItem = $prepared->fetch();
        $price = $lineItem['price'];
        $total += $row['quantity']*$price;

        echo '<tr>';
        echo '<td>Quote ID: '.$row['quote_id'].'</td>';
        echo '<td> --- Item ID: '.$row['item_id'].'</td>';
        echo '<td> ---  Quantity: '.$row['quantity'].'</td>';
        echo '<td> ---  Price: $'.$row['quantity']*$price.'</td>';
        echo '</tr>';
        echo ' ---- ';
        echo '<button onClick="document.location.href=\'quote.php\'">Edit</button>';
        echo '<button>Delete</button>';
        echo '</br>';
    }
    echo '<button onclick="showAddItem()">Add Line Item</button>';
    echo '<form id="addItem" style="display: none;">';
    echo '<button>Add Item</button>';
    echo '</form>';

    echo '<hr>';

    echo '<br>';
    echo '<p><strong>Notes:</p>';
    echo '<form>';
    echo '<textarea id="notes" rows="4" cols="50" maxlength="250"></textarea>';
    echo "<input type='submit' name='save_quote' value='Submit'>"; //submit button
    echo '</form>';
    echo '<br><br>';
?>