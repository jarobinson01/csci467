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

        function showEditNote(noteId) {
            var editNote = document.getElementById(noteId);
            editNote.disabled = false;
        }
    </script>
</html>

<?php
    session_start();

    include('config.php');

    // Display the line items for the quote selected
    $sql = "SELECT * FROM Quote_Item WHERE foreign_quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);

    $total = 0;
    echo '<h1>Quote #'.$_SESSION['QUOTE_ID'].'</h1>';
    echo '<form action=hq.php method=POST><button>BACK</button></form>';
    foreach($rows as $row) {
        $sql = "SELECT * FROM Item WHERE item_id = ".$row['foreign_item_id'].";";
        $item_id = $row['foreign_item_id'];

        $prepared = $db1->prepare($sql);
        $success = $prepared->execute();
        $lineItem = $prepared->fetch();
        $price = $lineItem['price'];

        global $total;
        $total += $price;

        echo '<tr>';
        echo '<td> Item Name: '.$lineItem['item_name'].'</td>';
        echo '<td> ---  Price: $'.number_format($price, 2, '.', '').'</td>';
        echo '</tr>';
        echo ' ---- ';
        // vvv EDIT ITEM FORM vvv
        echo '<form id="saveItem'.$item_id.'" action="edit_item.php" method="POST" style="display: none;">';
        echo '<input placeholder="Item Name" name="name" value="'.$lineItem['item_name'].'" required>';
        echo '<input placeholder="Item Price" name="price" value='.number_format($price, 2, '.', '').' required>';
        echo '<input type="submit" name="'.$item_id.'" value="Save Changes">';
        echo '</form>';
        // ^^^^^^^^^^^^^^^^^^^^^^
        $sql = "SELECT * FROM Quote WHERE quote_id = ?;";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute(array($_SESSION['QUOTE_ID']));
        $quote = $prepared->fetch();
        if($quote['status'] == 'Finalized') {
            echo '<button id="editItem'.$item_id.'" onclick="showEditItem(\''.$item_id.'\')">Edit</button>';
            echo '<form action="delete_item.php" method="POST" style="display: inline;">';
            echo '<input type="submit" name="'.$item_id.'" value="Delete">';
            echo '</form>';
            echo '</br>';
        }
    }

    // Add new line items
    if($quote['status'] == 'Finalized') {
        echo '<button id="newItem" onclick="showAddItem()">New Item</button>';
        echo '<form id="addItem" action="add_item.php" method="POST" style="display: none;">';
        echo '<input placeholder="Item Name" name="name" required>';
        echo '<input placeholder="Item Price" name="price" required>';
        echo '<input type="submit" value="Add Item">';
        echo '</form>';
    }

    // Display Totals and Discounts
    $sql = "SELECT * FROM Quote WHERE quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));
    $quote = $prepared->fetch();

    // Set quote price to 0 if it is less than 1
    $price = $quote['price'];
    if($price < 0) {
        $sql = "UPDATE Quote SET price=? WHERE quote_id=?;";
        $prepared = $db1->prepare($sql);
        $prepared->execute(array(0, $_SESSION['QUOTE_ID']));
    }

    echo '<hr>';
    echo '<h3>Total Quote Price:      $'.number_format($quote['price'], 2, '.', '').'</h3>';
    echo '<form action="apply_discount.php" method="POST">';
    echo '<input placeholder="Discount" name="discount" required>';
    echo '<input type="radio" id="percentage" name="discount_type" value="percentage" checked>';
    echo '<label for="percentage">percentage</label>';
    echo '<input type="radio" id="amount" name="discount_type" value="amount">';
    echo '<label for="amount">amount</label>';
    echo '<input type="submit">';
    echo '</form>';

    echo '<hr>';

    // Display Notes
    $sql = "SELECT * FROM Quote_Note WHERE foreign_quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    echo '<br>';
    echo '<p><strong>Notes:</p>';
    foreach($rows as $row) {
        $sql = "SELECT * FROM Note WHERE note_id = ".$row['note_id'].";";
        $prepared = $db1->prepare($sql);
        $success = $prepared->execute();
        $lineItem = $prepared->fetch();
        $note_id = $row['note_id'];
        echo '<form style="display: inline;">';
        echo '<input id="'.$note_id.'" value="'.$lineItem['text_field'].'" disabled>';
        echo '</form action>';
        echo '<button id="editNote'.$note_id.'" onclick="showEditNote(\''.$note_id.'\')">Edit</button>';
        echo '<form action="delete_note.php" method="POST" style="display: inline;">';
        echo '<input type="submit" name="'.$note_id.'" value="Delete">';
        echo '</form>';
        echo '</br>';
    }
    echo '<form action="add_note.php" method="POST">';
    echo '<input name="note" maxlength="250">';
    echo "<input type='submit' name='save_note' value='Save New Note'>";
    echo '</form>';
    echo '<br><br><br><br>';

    // Sanction or process quote
    $sql = "SELECT * FROM Quote WHERE quote_id = ?;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID']));
    $quote = $prepared->fetch();

    if($quote['status'] == 'Finalized') {
        echo '<form action="sanction_quote.php" method="POST">';
        echo '<input type="submit" value="SANCTION QUOTE" style="color:red;">';
        echo '</form>';
    } else if($quote['status'] == 'Sanctioned') {
        echo '<form action="sanction_quote.php" method="POST">';
        echo '<input type="submit" value="FINALIZE ORDER" style="color:blue;">';
        echo '</form>';
    }
?>