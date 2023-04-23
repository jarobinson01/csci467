<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);

   echo '<p>You have been logged out.</p>';
   echo '<a href="index.php">Log back in</a>';
?>