<html><head>
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head></html>

<?php
    try { // if something goes wrong, an exception is thrown
        include('config.php');
        session_start();
    } catch(PDOexception $e) { // handle that exception
        echo "Connection to database failed: " . $e->getMessage();
    }

    if(!isset($_POST['name'])) {
        echo "<div class=\"center\">"; //centers the entire first page
            echo "<h1>Login</h1>"; //header for main page
                echo "<form action=\"home.php\" method=\"POST\">"; //beginning of form
                    echo "<p>Enter Name: <input type=\"name\" name=\"name\" value=\"\"></p>"; //enter the name from user input
                    echo "<p>Enter Password: <input type=\"password\" name=\"password\" value=\"\"></p>"; //enter password from user input
                    echo "<input type=\"submit\" name=\"email-login\" value=\"Submit\">"; //submit button
                echo "</form>"; //end of form
        echo "</div>";
    }
?>