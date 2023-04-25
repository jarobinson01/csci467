<?php
    include('config.php');
    $QUOTE_ID = key($_POST);
    header("Location: quote.php");
?>