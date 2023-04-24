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
    include('functions.php');
    $id = array(key($_POST));

    $sql = "SELECT * FROM Quote_Item WHERE quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute($id);

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);

    display_quote($rows);
    
    function addItem() {
        $sql = "INSERT INTO Item (price) VALUES ('".$_POST['price']."');";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute();

        $sql = "INSERT INTO Quote_Item (quote_id, price) VALUES ('".$id."', '".$_POST['item_id']."', '".$_POST['price']."');";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute();
    }

    echo '<button id="newItem" onclick="showAddItem()">New Item</button>';
    echo '<form id="addItem" action="addItem()" method="POST" style="display: none;">';
    echo '<input placeholder="Item Name" name="item_id">';
    //echo '<input placeholder="Item Quantity">';
    echo '<input placeholder="Item Price" name="price">';
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