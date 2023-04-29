<?php
    include('secrets.php');

    $dsn = "mysql:host=courses;dbname=z1934222";
    $db1 = new PDO($dsn, $username, $password);
    $db2 = new PDO("mysql:host=blitz.cs.niu.edu;dbname=csci467", 'student', 'student');

    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">';
?>