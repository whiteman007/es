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

    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <a class="navbar-brand font-weight-bolder mr-3" href="index.php"><img src="assets/img/logo_Semia.png"></a>
    <button class="navbar-light navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsDefault">
    	<ul class="navbar-nav  align-items-right">
    		
    	
		<?php
					
					$sql = "SELECT category_id,arabic_name FROM main_categories";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					// output data of each row
						while($row = $result->fetch_assoc()) {
							$cat_id=$row["category_id"];					
							$cat = $row["arabic_name"];
							
							$sql_get_sub="SELECT category_id, arabic_name FROM sub_categories where main_category=".(int)$cat_id;
							
							$result_sub = $conn->query($sql_get_sub);
							if ($result_sub->num_rows > 0) {
								echo "<li class='nav-item dropdown'>"
					."<a class='nav-link dropdown-toggle' href='' id='dropdown01' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>". $cat."</a>"
    				."<div class='dropdown-menu shadow-lg' aria-labelledby='dropdown01'>";
								while($sub_row=$result_sub->fetch_assoc()){
									$sub_cat_id=$sub_row["category_id"];
									$sub_cat=$sub_row["arabic_name"];
									#echo $sub_cat;
					//echo $cat. "<br>";
					//echo "<li class='nav-item'><a class='nav-link' href='#'>". $cat."</a></li>";
    				echo"<a class='dropdown-item' href='category.php?cat=".$cat_id."-".$sub_cat_id."'>".$sub_cat."</a>";			
					
								}
								echo"</div>";
					
					
  }else{echo "<li class='nav-item'><a class='nav-link' href='category.php?cat=".$cat_id."-0'>". $cat."</a></li>";}
						}
} else {
  //echo "0 results";
  
}
?>
<li class='nav-link'>
<form class="bd-search hidden-sm-down">
    			<input type="text" class="form-control bg-graylight border-0 font-weight-bold" id="search-input" placeholder="ابحث عن..." autocomplete="off">
    			<div class="dropdown-menu bd-search-results" id="search-results">
    			</div>
    		</form>
			</li>
    	</ul>
    </div>
    	
    </nav>    
    <main role="main">
        <br/>
    
    <section class="mt-4 mb-5">
    <div class="container mb-4">
    	<div class="row">
    		<nav class="navbar navbar-expand-lg navbar-light bg-white pl-2 pr-2">
    		<button class="navbar-light navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExplore" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarsExplore">
    			<ul class="navbar-nav">
    				<li class="nav-item">
			
    			</ul>
    		</div>
    		</nav>
    	</div>
    </div>


	
    </section>
        
    </main>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/theme.js"></script>
    
   
        
         

    <div class="container">
<form id="imageform" name="imageform" action="file_upload.php" method="POST" enctype="multipart/form-data">

  
  <div class="form-outline mb-4">
  
    <label class="form-label" for="customFile">اختر الملف</label>
	 <input type="submit" name="submit" value="Upload">
	<input type="file" class="form-control" id="customFile" style="visibility:hidden; " name="files[]" multiple />
<!--<br/><br/>-->


  
  
 
			
          
        


	<!-- Text input
    <input type="file" id="myfile" name="myfile" style="visibility:hidden;align:center;" multiple><br><br>
	<button id="OpenImgUpload">إختر الملف</button>
	<input type="submit">
  </div> -->
  
  
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
       <input type="text" id="form6Example1" class="form-control" disabled /> 
	   <br/>
        <label class="form-label" for="form6Example1">الشهر</label>

  
  <select name="month" id="month" class="form-control">
    
</select>

  <script type="text/javascript">
var d = new Date();
var monthArray = new Array();
monthArray[0] = "1-كانون الثاني";
monthArray[1] = "2- شباط";
monthArray[2] = "3- آذار";
monthArray[3] = "4- نيسان";
monthArray[4] = "5- ايار";
monthArray[5] = "6- حزيران";
monthArray[6] = "7- تموز";
monthArray[7] = "8- آب";
monthArray[8] = "9- أيلول";
monthArray[9] = "10- تشرين الأول";
monthArray[10] = "11- تشرين الثاني";
monthArray[11] = "12- كانون الأول";
for(m = 0; m <= 11; m++) {
    var optn = document.createElement("OPTION");
    optn.text = monthArray[m];
    // server side month start from one
    optn.value = (m+1);
    // if june selected
    if ( m == 0) {
        optn.selected = true;
    }
    document.getElementById('month').options.add(optn);
}
</script>

      </div>
    </div>
    <div class="col">
      <div class="form-outline">
     
        <label class="form-label" for="form6Example2" >السنة</label>
		<select id='date-dropdown' class="form-control">
</select>


<script>
  let dateDropdown = document.getElementById('date-dropdown'); 
       
  let currentYear = new Date().getFullYear();    
  let earliestYear = 2015;     
  while (currentYear >= earliestYear) {      
    let dateOption = document.createElement('option');          
    dateOption.text = currentYear;      
    dateOption.value = currentYear;        
    dateDropdown.add(dateOption);      
    currentYear -= 1;    
  }
</script>

      </div>
    </div>
  </div>

<br/><br/>



  <div class="form-outline mb-4">
    <textarea class="form-control" id="form6Example7" rows="4"></textarea>
    <label class="form-label" for="form6Example7">المناسبة</label>
  </div>

  <div class="form-outline mb-4">
    <textarea class="form-control" id="form6Example7" rows="4"></textarea>
    <label class="form-label" for="form6Example7">علامات(تاغ)</label>
  </div>

  <div class="form-outline mb-4">
    <textarea class="form-control" id="form6Example7" rows="4"></textarea>
    <label class="form-label" for="form6Example7">الوصف</label>
  </div>



  <button type="submit" class="btn btn-primary btn-block mb-4">حفظ</button>
</form>

 <footer class="footer pt-5 pb-5 text-center">
        
    <div class="container">
        
          <div class="socials-media">
    
            <ul class="list-unstyled">
              <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-facebook"></i></a></li>
              <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-twitter"></i></a></li>
              <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-instagram"></i></a></li>
                      </ul>
					  <?php $conn->close(); ?>
    
          </div>

		</div> 
    
        </div>
        
    </footer>    
	
	<script>

   $('#customFile').on('change',function(){
      $('#imageform').submit();
   });

</script>
</body>
    
</html>
