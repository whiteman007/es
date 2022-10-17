<?php
$i=0;
$file=[];
$filenames="";
$count=count(array_filter($_FILES['files']['name']))-1;
$total_count=count(array_filter($_FILES['files']['name']));

if(isset($_POST['submit'])) {

$upload_dir = 'uploads'.DIRECTORY_SEPARATOR;


if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}


 $allowed_types = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
 

 $maxsize = 500000 * 1024 * 1024;

if(!empty(array_filter($_FILES['files']['name']))) {
	
	//echo count(array_filter($_FILES['files']['name']))."<br/>";
foreach ($_FILES['files']['tmp_name'] as $key => $value) {
	$j=$i+1;
	$fn=$_FILES['files']['name'][$i];
	//echo $fn;
	//echo implode(" ",$_FILES['files']['name']);
	//$fn=implode(" ",$_FILES['files']['name']);
	
	if($i<$count){
		
		$filename="f".$j."=".$fn."&";
		
		//echo $filename;

	$filenames=$filenames.$filename;
	}
	else{
		$filename="f".$j."=".$fn;
			$filenames=$filenames.$filename;

	//echo $filenames;
	}
   //echo "f".$i."<br/>";
   $file_tmpname = $_FILES['files']['tmp_name'][$key];
   $file_name = $_FILES['files']['name'][$key];
   $file_size = $_FILES['files']['size'][$key];
   $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
// Upload file path
   $filepath = $upload_dir.$file_name;
// Check file type is allowed or not
   if(in_array(strtolower($file_ext), $allowed_types)) {
// Verify file size - 5MB max
    if ($file_size > $maxsize)  {
     //echo "Error: File size is larger than the allowed limit."."<br/>";
 //header("Location: upload.php?u=0");
//exit();
	}
// Check file already exist or not
    if(file_exists($filepath)) {
     
     //echo "{$file_name} already exists"."<br/>";
     
    } else {
    
     if( move_uploaded_file($file_tmpname, $filepath)) {
		 //$file=array("filename"=>$file_tmpname,"type"=>$file_ext);
		 array_push($file, $file_tmpname, $file_ext);
      //echo "{$file_name} successfully uploaded"."<br/>";
	  //header("Location: upload.php?u=1");
//exit();
     }
     else {     
      //echo "Error: uploading {$file_name}"."<br/>";
	  //echo "{$filepath} :)"."<br/>";
	  //header("Location: upload.php?u=0");
//exit();
     }
}
   }
   else {
    
    // If file extension not valid
    //echo "{$file_ext} file type is not allowed"."<br/>";
	//header("Location: upload.php?u=0");
//exit();
    
   }
   $i++;
  }
 }
 else { 
  //echo "No files selected."."<br/>";
  //header("Location: upload.php?u=0");
//exit();
 }
 
}
//print_r($file);
//var_dump($file);

//echo $filenames;
header("Location: uploaded_files.php?u=1&".$filenames."&t=".$total_count);
exit();
//echo "test=".$filenames;


?>