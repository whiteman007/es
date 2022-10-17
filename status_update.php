<?php 


$camp_id=$_POST['cid'];
	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sel = "SELECT campaign_status FROM campaigns where campaign_id=".$camp_id;
$result = mysqli_query($conn, $sel);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    if($row['campaign_status']==0){$status=1;}
	else{$status=0;}
  }
} else {
  echo "0 results";
}





$sql = "UPDATE campaigns SET campaign_status=".$status." WHERE campaign_id=".$camp_id;
	
if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();

?>