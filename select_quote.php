<?php
    echo $QUOTE_ID;
    include('config.php');
    $QUOTE_ID = key($_POST);
    echo $QUOTE_ID;
    //header("Location: quote.php");
?>