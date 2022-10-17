<?php


$camp_id=$_POST['cid'];
	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8"); 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sel = "SELECT * FROM campaigns where campaign_id=".$camp_id;
$result = mysqli_query($conn, $sel);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
	$camp_id=$row['campaign_id'];
    $camp_title=$row['campaign_title'];
	$camp_text=$row['campaign_text'];
	$camp_hashtag=$row['campaign_hashtag'];
	
}
}
$conn->close();

$arr = array();
$arr[0]=$camp_id;
$arr[1] = $camp_title;
$arr[2] = $camp_text;
$arr[3] = $camp_hashtag;

echo json_encode($arr);
//$postData = json_encode($arr);
//exit();

//echo count($arr);
//echo $camp_hashtag;


?>