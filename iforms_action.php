<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";
$ids_array=[];
$main_cat=$_POST['main_cat'];
$sub_cat=$_POST['sub_cat'];
$tablename=$sub_cat."_files";
$sql_main="SELECT category_name FROM main_categories WHERE category_id=".$main_cat;
$sql_sub="SELECT category_name FROM sub_categories WHERE category_id=".$sub_cat;
$sql_max="SELECT MAX(file_number) AS last FROM ".$tablename.";";
//echo $sql_max;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$cat_res=$conn->query($sql_main);
if ($cat_res->num_rows>0){
while ($row=$cat_res->fetch_assoc()){$cat_name=$row["category_name"];}	
}

$date = date('Y-m-d H:i:s');
//echo $date;


$sub_res=$conn->query($sql_sub);
if ($sub_res->num_rows>0){
while ($row=$sub_res->fetch_assoc()){$sub_name=$row["category_name"];}	
}

//echo $sub_name;


//echo $cat_name;

$result = $conn->query($sql_max);

if (!empty($result) && $result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $last= $row["last"];
	echo $last;
  }
 
} else {
  $last=0;
}


$fid=$last+1;
echo $fid;
//foreach($_POST as $key => $value){
  // print_r($value);
//}

$total_uploaded=$_POST['total'];
$deleted_files=$_POST['deleted'];

//$test=$_POST['type1'];
//echo "<br/>type test ".$test."<br/>";

//echo $total_uploaded;
if($deleted_files!=0){//echo "<br/>".$deleted_files."<br/>";
}
else{//echo "\n No deleted files! \n";
}



$del_arr = explode(',', $deleted_files);
for ($i=1;$i<=$total_uploaded;$i++){
	if (in_array($i,$del_arr)==false){
		$type=$_POST['type'.$i];
		switch($type){
			case "1":
			$type_abbr="i";
			$file_type="image";
			break;
			case "2":
			$type_abbr="p";
			$file_type="poster";
			break;
			case "3":
			$type_abbr="ig";
			$file_type="infographic";
			break;
			case "4":
			$type_abbr="v";
			$file_type="video";
			break;
			case "5":
			$type_abbr="vg";
			$file_type="videographic";
			break;
		}
		//echo $type;
		
		//echo "<br/>".$fid;
		$file_id=$type_abbr.".".$main_cat.".".$sub_cat."-".$fid;
		//echo "<br/>".$file_id;
		$name=$_POST['uploaded_file_name'.$i];
		//echo "<br/>".$name."<br/>";
	    $temp= explode('.',$name);	
		$extension = end($temp);
		$file_name=$file_id.".".$extension;
		//echo $file_name;
		$year=$_POST['year'.$i];
		$month=$_POST['month'.$i];
		$desc=$_POST['description'.$i];
		$tags=$_POST['tags'.$i];
		$search=$_POST['search'.$i];
		$pr=$_POST['priority'.$i];
		//echo $pr;
		//echo $desc."<br/>".$tags."<br/>".$search;
		$path="files/".$file_type."/".$year."/".$month."/".$cat_name."/".$sub_name."/";
		//echo $path;
		array_push($ids_array,$file_id);
		if (!file_exists($path)) {
    mkdir($path, 0777, true);
}
$filepath=$path."thumbnails/";
		$name = $_FILES['imageupload'.$i]['name'];//Name of the File
    $temp = $_FILES['imageupload'.$i]['tmp_name'];
		if(move_uploaded_file($temp, $filepath . $name)){
        echo "success";
    }else{
        echo "failed";
    }
		rename("uploads/".$name, $path.$file_name);
		
		$sql="INSERT IGNORE  INTO ".$tablename." (file_id, file_name, file_path, type, tags, month, year,cat_id, entry_date, description, caption, priority,thumbnail) VALUES ('".$file_id."','".$file_name."','".$path."','".$file_type."','".$tags."','".$month."','".$year."','".$main_cat."','".$date."','".$desc."','".$search."','".$pr."','".$thumbnail."');";
	//echo $sql;
	if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$fid=$fid+1;
	}
	
print_r($ids_array);	
}


$conn->close();
?>