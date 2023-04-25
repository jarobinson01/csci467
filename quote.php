<html>
    <script>
        function showAddItem() {
            var newItem = document.getElementById("newItem");
            var addItem = document.getElementById("addItem");
            addItem.style.display = "block";
            newItem.style.display = "none";
        }

        function showEditItem(itemId) {
            var editItem = document.getElementById("editItem" + itemId);
            var saveItem = document.getElementById("saveItem" + itemId);
            editItem.style.display = "none";
            saveItem.style.display = "inline";
        }
    </script>
</html>

<?php
    session_start();

    include('config.php');

    // Display the line items for the quote selected
    $sql = "SELECT * FROM Quote_Item WHERE quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    //print_r($rows);
    $total = 0;
    echo '<h1>Quote #'.$_SESSION['QUOTE_ID'].'</h1>';
    echo '<form action=hq.php method=POST><button>BACK</button></form>';
    foreach($rows as $row) {
        $sql = "SELECT * FROM Item WHERE id = ".$row['item_id'].";";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute();
        $lineItem = $prepared->fetch();
        $price = $lineItem['price'];
        $total += $row['quantity']*$price;
        $item_id = $row['item_id'];

        echo '<tr>';
        echo '<td>Quote ID: '.$row['quote_id'].'</td>';
        echo '<td> --- Item Name: '.$lineItem['name'].'</td>';
        echo '<td> ---  Price: $'.$price.'</td>';
        echo '</tr>';
        echo ' ---- ';
        // vvv EDIT ITEM FORM vvv
        echo '<form id="saveItem'.$item_id.'" action="edit_item.php" method="POST" style="display: none;">';
        echo '<input placeholder="Item Name" name="name" value="'.$lineItem['name'].'" required>';
        echo '<input placeholder="Item Price" name="price" value="'.$price.'" required>';
        echo '<input type="submit" name="'.$item_id.'" value="Save Changes">';
        echo '</form>';
        // ^^^^^^^^^^^^^^^^^^^^^^
        echo '<button id="editItem'.$item_id.'" onclick="showEditItem(\''.$item_id.'\')">Edit</button>';
        echo '<button>Delete</button>';
        echo '</br>';
    }

    // Add new line items and notes
    echo '<button id="newItem" onclick="showAddItem()">New Item</button>';
    echo '<form id="addItem" action="add_item.php" method="POST" style="display: none;">';
    //echo '<input type="hidden" name="quote_id" value="'.$QUOTE_ID.'">'; //* CAN DELETE LATER IF QUOTE_ID WORKS */
    echo '<input placeholder="Item Name" name="name" required>';
    //echo '<input placeholder="Item Quantity">';
    echo '<input placeholder="Item Price" name="price" required>';
    echo '<input type="submit" value="Add Item">';
    echo '</form>';

    echo '<hr>';

    echo '<br>';
    echo '<p><strong>Notes:</p>';
    echo '<form>';
    echo '<textarea id="notes" rows="4" cols="50" maxlength="250"></textarea>';
    echo "<input type='submit' name='save_quote' value='Submit'>";
    echo '</form>';
    echo '<br><br>';
?>