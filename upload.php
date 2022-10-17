<!DOCTYPE html>

<html lang="ar" dir="rtl">


<?php
//php_mysql_connection_and_get_categories
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully";
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الصفحة الرئيسية</title>
	<link rel="shortcut icon" href="assets/img/logo.png">
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/theme.css">
    <!--<link rel="stylesheet" href="assets/css/bootstrap.css">-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</head>

<body>

   
        
         

    <div class="container">
<form id="imageform" name="imageform" action="file_upload.php" method="POST" enctype="multipart/form-data">

  
  <div class="form-outline mb-4">
  
   <center> <label class="form-label" for="customFile">  اختر الملف / الملفات &nbsp;  <i class="fa fa-upload" style="font-size:48px;color:red"></i></label></center>
	<br/>
	 <center><input type="submit" name="submit" value="تحميل"></center>
	<input required type="file" class="form-control" id="customFile" style="visibility:hidden; " name="files[]" multiple />
</form>

 <footer class="footer pt-5 pb-5 text-center">
        
    
          
    </footer>    
	
	<!--<script>

   $('#customFile').on('change',function(){
      $('#imageform').submit();
   });

</script>-->
</body>
    
</html>
