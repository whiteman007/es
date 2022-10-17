<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   unset($_SESSION["id"]);
   unset($_SESSION["name"]);
   //echo 'You have cleaned session';
   header('Refresh: 2; url = login.php');
?>