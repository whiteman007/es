<?php
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "website_db";
	$con = mysqli_connect($dbhost, $dbuser, $dbpass , $db) or die($con);
	mysqli_set_charset($con,"utf8");


?>