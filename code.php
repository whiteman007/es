<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";


$camp_title=$_POST['title'];
$camp_text=$_POST['text'];
$camp_hashtag=$_POST['hashtag'];



$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8"); 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['to_edit_id'])&& $_POST['to_edit_id']!="" )
{
	
	$sql = "UPDATE campaigns SET campaign_title='".$camp_title."' ,campaign_text='".$camp_text."' ,campaign_hashtag='".$camp_hashtag."' WHERE campaign_id=".$_POST['to_edit_id'];
	echo $sql."<br/>";
if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
  echo "<script LANGUAGE='JavaScript'>
    window.alert('تم التعديل');
    window.location.href='campaign.php';
    </script>";
} else {
  echo "Error updating record: " . $conn->error;
}

}
else{



//echo "<br/>".$camp_title."<br/>".$camp_text."<br/>".$camp_hashtag;



$sql="INSERT IGNORE  INTO campaigns (campaign_title, campaign_text, campaign_hashtag) VALUES ('".$camp_title."','".$camp_text."','".$camp_hashtag."');";
	
	
	//echo $sql;
	if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  echo "<script LANGUAGE='JavaScript'>
    window.alert('تمت الإضافة');
    window.location.href='campaign.php';
    </script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

}
	
//header("Location: campaign.php");

	

?>