<?php
    try { // if something goes wrong, an exception is thrown
        include('config.php');
        session_start();

        $_SESSION["QUOTE_ID"] = -1;
    }
    catch(PDOexception $e) { // handle that exception
        echo "Connection to database failed: " . $e->getMessage();
    }

    $name = $_POST['name'];
    $password = $_POST['password'];

    $login = false;
    
    $associate = false;
    $admin = false;
    $hq = false;


    //GET ALL USER INFORMATION
    $sql = "SELECT * FROM User WHERE name = \"".$name."\";";
    $prepared = $db1->prepare($sql);
    $success = $prepared->execute();

    $rows = $prepared->fetchALL(PDO::FETCH_ASSOC);

    //CHECK PASSWORD
    foreach ($rows as $row) {
        if ($password != $row['password']){
            echo "password is incorrect <br/>";
            break;
        }

        $login = true;

        //CHECK USER TYPE
        if ($row['is_associate']){
            $associate = true;
        }

        if ($row['is_admin']){
            $admin = true;
        }

        if ($row['is_hq']){
            $hq = true;
        }

    }
    if (!$login){ //CHECK FOR LOGIN, THEN REDIRECT
        echo "Incorrect Login Information";
        echo "<form action=\"index.php\" method=\"post\">";
            echo "<button type=\"submit\">Back to Login</button>";
        echo "</form>";
    }
    if ($associate){
        echo "You have associate privleges!<br/>";
        include('associate.php');
    }
    if ($admin){
        include('admin.php');
    }
    echo "<br/><br/>";
    if ($hq){
        echo "You have hq privleges!<br/>";
        include('hq.php');
        header("Location: hq.php");
    }

?>