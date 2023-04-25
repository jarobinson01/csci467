<html><head>
    <title>Login Page</title>
</head></html>

<?php
    try { // if something goes wrong, an exception is thrown
        include('config.php');
        session_start();
    } catch(PDOexception $e) { // handle that exception
        echo "Connection to database failed: " . $e->getMessage();
    }

    // get data from the SQL file
	$query = file_get_contents("script.sql");

	// prepare the SQL statements
	$stmt = $db1->prepare($query);

	// execute the SQL
	if ($stmt->execute()){
		echo "Success";
	}
	else {
		echo "Fail";
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