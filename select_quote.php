<?php
    session_start();
    
    include('config.php');
    $_SESSION['QUOTE_ID'] = key($_POST);
    header("Location: quote.php");
?>