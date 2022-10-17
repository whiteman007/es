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
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$cat_res=$conn->query($sql_main);
if ($cat_res->num_rows>0){
while ($row=$cat_res->fetch_assoc()){$cat_name=$row["category_name"];}	
}

//$date = date('Y-m-d H:i:s');
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
echo  "<br>";
//if(sizeof($del_arr)==$total_uploaded){
	//echo "failed\n";
	//echo sizeof($del_arr);
	//echo $total_uploaded;
	//print_r(sizeof($del_arr));
	//echo ("<script LANGUAGE='JavaScript'>
    //window.alert('لا يوجد أي ملف للتحميل');
    //window.location.href='upload.php';
    //</script>");
	
	
//}
	
//else{

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
		$u_f_name=$_POST['uploaded_file_name'.$i];
		//echo "<br/>".$name."<br/>";
	    $temp= explode('.',$u_f_name);	
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

$name="";
$final_name="";

if($type_abbr=="v" || $type_abbr=="vg"){	
if ($_FILES['imageupload'.$i]['size'] == 0 && $_FILES['imageupload'.$i]['error'] == 0){$name="";}	
else{
$filepath=$path."thumbnails/";
$final_filepath=$filepath."final/";

$temp = $_FILES['imageupload'.$i]['tmp_name'];
$file_temp_name = $_FILES['imageupload'.$i]['name'];
$file_ext = pathinfo($file_temp_name, PATHINFO_EXTENSION);
$name = $file_id."-thumbnail.".$file_ext;

if (!file_exists($filepath)) 
mkdir($filepath, 0777, true);
if(move_uploaded_file($temp, $filepath . $name)){
        echo "success";
    }else{
        echo "failed";
    }
   
$width = 500;
$height = 500;

$layers = array();


$layers[] = imagecreatefromjpeg($filepath.$name);
$layers[] = imagecreatefrompng("assets/img/placeholder.png");
$image = imagecreatetruecolor($width, $height);

// to make background transparent?
imagealphablending($image, false);
$transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $transparency);
imagesavealpha($image, true);

imagealphablending($image, true);
for ($i = 0; $i < count($layers); $i++) {
    imagecopy($image, $layers[$i], 0, 0, 0, 0, $width, $height);
}
imagealphablending($image, false);
imagesavealpha($image, true);

if (!file_exists($final_filepath)) 
mkdir($final_filepath, 0777, true);

$final_name=$final_filepath.$file_id."-final.".$file_ext;

imagejpeg($image,$final_name ); 
	
	}}}
	
		rename("uploads/".$u_f_name, $path.$file_name);
		
		$sql="INSERT IGNORE  INTO ".$tablename." (file_id, file_name, file_path, type, tags, month, year,cat_id,  description, caption, priority,thumbnail,final_thumbnail) VALUES ('".$file_id."','".$file_name."','".$path."','".$file_type."','".$tags."','".$month."','".$year."','".$sub_cat."','".$desc."','".$search."','".$pr."','".$name."','".$final_name."');";
	
		$sql_all_files="INSERT IGNORE  INTO all_files (file_id, file_name, file_path, type, tags, month, year,cat_id,  description, caption, priority,thumbnail,final_thumbnail) VALUES ('".$file_id."','".$file_name."','".$path."','".$file_type."','".$tags."','".$month."','".$year."','".$sub_cat."','".$desc."','".$search."','".$pr."','".$name."','".$final_name."');";
	
	
	
	echo $sql;
	if (($conn->query($sql) === TRUE)&&($conn->query($sql_all_files) === TRUE)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$fid=$fid+1;
	}
	

print_r($ids_array);	


//}
$conn->close();


$dir="uploads/";


if (is_dir($dir))
 {
  $objects = scandir($dir);

  foreach ($objects as $object)
  {
   if ($object != '.' && $object != '..')
   {
    if (filetype($dir.'/'.$object) == 'dir') {rmdir($dir.'/'.$object);}
    else {unlink($dir.'/'.$object);}
   }
  }

  reset($objects);
  rmdir($dir);
 }
 echo ("<script LANGUAGE='JavaScript'>
    window.alert('تم التحميل');
    window.location.href='upload.php';
    </script>");
	
?>