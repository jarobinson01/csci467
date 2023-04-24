<html>
    <script>
        function showAddItem() {
            var newItem = document.getElementById("newItem");
            var addItem = document.getElementById("addItem");
            addItem.style.display = "block";
            newItem.style.display = "none";
        }

        function itemAdded() {
            var newItem = document.getElementById("newItem");
            var addItem = document.getElementById("addItem");
            addItem.style.display = "none";
            newItem.style.display = "block";
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
    echo '<button id="newItem" onclick="showAddItem()">New Item</button>';
    echo '<form id="addItem" style="display: none;">';
    echo '<input value="Item Name">';
    echo '<input value="Item Price">';
    echo '<button id="addItem" onclick="itemAdded()">Add Item</button>';
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