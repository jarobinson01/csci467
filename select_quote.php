<?php
    include('config.php');
    echo $QUOTE_ID;
    $QUOTE_ID = key($_POST);
    echo $QUOTE_ID;
    //header("Location: quote.php");
?>