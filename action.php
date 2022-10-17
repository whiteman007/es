<?php
// Include the database connection file
include('db_config.php');

if (isset($_POST['mainId']) && !empty($_POST['mainId'])) {



	$query = "SELECT category_id, arabic_name FROM sub_categories where main_category=".$_POST['mainId'];
	$result = $con->query($query);

	if ($result->num_rows > 0) {
		echo '<option hidden disabled selected value> -- اختر التصنيف -- </option>'; 
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['category_id'].'">'.$row['arabic_name'].'</option>'; 
		}
	} else {
		echo '<option value="">'.$mainId.'</option>';
	
	}
}
else{
echo ''; 

}

?>
 