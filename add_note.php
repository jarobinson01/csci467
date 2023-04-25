<?php
    session_start();

    include('config.php');

    // Get current id value for the Note that will be added
    $sql = "SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = 'z1923374'
            AND   TABLE_NAME   = 'Note';";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $note_id = $prepared->fetch();
    print_r($note_id);

    // Insert row into Note table
    $sql = "INSERT INTO Note (text_field) VALUES (?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_POST['note']));

    // Insert row into Quote_Note table
    $sql = "INSERT INTO Quote_Note (foreign_quote_id, note_id) VALUES (?, ?);";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute(array($_SESSION['QUOTE_ID'], $note_id[0]));

    $sql = "SELECT * FROM Quote_Note;";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();
    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($rows);

    // Redirect to quote page
    //header("Location: quote.php");
?>