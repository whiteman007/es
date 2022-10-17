<!DOCTYPE html>

<html lang="ar" dir="rtl">


<?php
//php_mysql_connection_and_get_categories
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";
$cat=$_GET["cat"];
$pieces = explode("-", $cat);
$main=$pieces[0]; 
$sub=$pieces[1];

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
    <title>...</title>
	<link rel="shortcut icon" href="assets2/img/logo.png">
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <link rel="stylesheet" href="assets2/css/app.css">
    <link rel="stylesheet" href="assets2/css/theme.css">
	
	
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


    <link rel="stylesheet" href="assets2/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="assets2/css/style.css"> <!-- Resource style -->
	<script src="assets2/js/modernizr.js"></script> <!-- Modernizr -->

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<style>
.fa li:hover {
background-color: rgba(242, 242, 242, 1);
}
.fa .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: white;
  color: #808080;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.fa:hover .tooltiptext {
  visibility: visible;
}
</style>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <a class="navbar-brand font-weight-bolder mr-3" href="index.php"><img src="assets2/img/logo_Semia.png"></a>
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
								if($cat_id==$main){
									echo "<li class='nav-item dropdown'>"
					."<a class='nav-link dropdown-toggle' href='' id='dropdown01' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='color: #bd081c;'>". $cat."</a>"
    				."<div class='dropdown-menu shadow-lg' aria-labelledby='dropdown01'>";
					while($sub_row=$result_sub->fetch_assoc()){
									$sub_cat_id=$sub_row["category_id"];
									$sub_cat=$sub_row["arabic_name"];
									#echo $sub_cat;
					//echo $cat. "<br>";
					//echo "<li class='nav-item'><a class='nav-link' href='#'>". $cat."</a></li>";
					if($sub_cat_id==$sub){
    				echo"<a class='dropdown-item' href='category.php?cat=".$cat_id."-".$sub_cat_id."' style='color:#fff;text-decoration:none;background-color:#bd081c;'>".$sub_cat."</a>";			
					}
					else{echo"<a class='dropdown-item' href='category.php?cat=".$cat_id."-".$sub_cat_id."'>".$sub_cat."</a>";}
								}
								echo"</div>";
								}
								else{
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
					
					
								}
  }else{echo "<li class='nav-item'><a class='nav-link' href='category.php?cat=".$cat_id."-0'>". $cat."</a></li>";}
						}
} else {
  //echo "0 results";
}
//$conn->close();?>
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
	<br/>
	<br/>
	
    <section class="mt-4 mb-5">
    <div class="container mb-4">
	
    	<div class="row">

    		<nav class="navbar navbar-expand-lg navbar-light bg-white pl-2 pr-2">
    		<span class="navbar-toggler-icon"></span>
    		<div class="collapse navbar-collapse" id="navbarsExplore">
    			<ul class="navbar-nav">
    				<li class="nav-item">
			  <li> <i class='icon-arrow-up'></i><i class='icon-arrow-down'></li>
    			</ul>
    		</div>
    		</nav>
    	</div>
    </div>

    <div class="container-fluid">
	
			<div class="cd-tab-filter-wrapper">
			<div class="cd-tab-filter">
				<ul class="cd-filters">

					<li class="filter" data-filter=".color-2"></li>
					
				
					
					<i style="font-size:24px" class="fa">&#xf0d7; <span class="tooltiptext" style="font-size:16px">الأجدد</span></i></li>
					<i style="font-size:24px" class="fa">&nbsp;</i>
					<i style="font-size:24px" class="fa">&#xf0d8;<span class="tooltiptext" style="font-size:16px">الأقدم</span></i>
				<i style="font-size:24px" class="fa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>

					<li class="placeholder"> 
						<a data-type="all" href="#0">All</a> <!-- selected option on mobile -->
					</li> 
					<li class="filter"><a class="selected" href="#0" data-type="all">الكل</a></li>			
				    <li class="filter" data-filter=".color-1"><a href="" data-type="color-1">انفوغراف</a></li>
					<li class="filter" data-filter=".color-2"><a href="" data-type="color-2">بوستر</a></li>
					<li class="filter" data-filter=".color-3"><a href="" data-type="color-2">صور</a></li>
					<li class="filter" data-filter=".color-4"><a href="" data-type="color-2">فيديو</a></li>
					<li class="filter" data-filter=".color-5"><a href="" data-type="color-2">فيديوغراف</a></li>
					<li class="filter" data-filter=".color-5"><a id="discard" name="discard" href="" data-type="color-2">&nbsp;&times;&nbsp;</a></li>
				</ul> <!-- cd-filters -->

			</div> <!-- cd-tab-filter -->
		</div> <!-- cd-tab-filter-wrapper -->
	
		<div class="row mb-4">
		
<form class="row row-cols-lg-auto g-3 align-items-center" id="myform" action="sort_and_filter.php" method="post"> 		

	
    <div class="col">
 
     
        <!--<label class="form-label" for="form6Example2" >السنة</label>-->
		<label></label>
		<select id='date-dropdown' class="form-control">
		<option hidden disabled selected value> -- اختر السنة -- </option>
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
	
	
	    <div class="col">
   
        <!--<label class="form-label" for="form6Example1">الشهر</label>-->
<label></label>
  
  <select name="month" id="month" class="form-control">
    <option hidden disabled selected value> -- اختر الشهر -- </option>
</select>

  <script type="text/javascript">
var d = new Date();
var monthArray = new Array();
monthArray[1] = "1-كانون الثاني";
monthArray[2] = "2- شباط";
monthArray[3] = "3- آذار";
monthArray[4] = "4- نيسان";
monthArray[5] = "5- ايار";
monthArray[6] = "6- حزيران";
monthArray[7] = "7- تموز";
monthArray[8] = "8- آب";
monthArray[9] = "9- أيلول";
monthArray[10] = "10- تشرين الأول";
monthArray[11] = "11- تشرين الثاني";
monthArray[12] = "12- كانون الأول";
for(m = 1; m <= 12; m++) {
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
<!--
<div class="col">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
 -->

</form>
				
	</div>	
		

<!-- Page Content -->

		
		<br/>
		

    	<div class="row">
    		<div class="card-columns">
			
			 <?php

$showRecordPerPage = 20;
	if(isset($_GET['page']) && !empty($_GET['page'])){
		$currentPage = $_GET['page'];
	}else{
		$currentPage = 1;
	}
	$startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
	//$totalEmpSQL = "SELECT * FROM all_files where type='1' or type='4' order by RAND()";
	$totalEmpSQL = "SELECT * FROM ". $sub."_files order by RAND()";
	$allEmpResult = mysqli_query($conn, $totalEmpSQL);
	$totalEmployee = mysqli_num_rows($allEmpResult);
	$lastPage = ceil($totalEmployee/$showRecordPerPage);
	$firstPage = 1;
	$nextPage = $currentPage + 1;
	$previousPage = $currentPage - 1;
	$empSQL = "SELECT file_id, file_path, file_name, type, cat_id
	FROM ". $sub."_files LIMIT $startFrom, $showRecordPerPage";
	$empResult = mysqli_query($conn, $empSQL);								
	if(mysqli_fetch_assoc($empResult)==0){$lastPage="1";}				
				while($row = mysqli_fetch_assoc($empResult)){	
							$file_id=$row["file_id"];
							$path=$row["file_path"];					
							$name = $row["file_name"];
							$typ= $row["type"];
							$category_id=$row["cat_id"];				
							
							if ($typ!="4"){
							$sql2="SELECT arabic_name FROM sub_categories where category_id=".(int)$category_id;

							$res=$conn->query($sql2);
							if($res->num_rows>0){
								while($r=$res->fetch_assoc()){
								$a_name=$r["arabic_name"];
								//echo $a_name;
								}
							}
							echo'<br/><div class="card card-pin">'.
							'<img class="card-img" src='.$path.$name.' >'.
							'<div class="overlay">'.
							'<h2 class="card-title title">'.$a_name.'</h2>'.
							'<div class="more">'.
    						'<a href="post.php?file='.$file_id.'">'.
    						'<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>  </a>'.
							'</div>'.
							'</div>'.
							'</div>';
							}
						else{
							echo '<br/><div>'.
				'<a href="video.php?file='.$file_id.'">'.
				'<video class="card-img" width="320" height="240" autoPlay loop muted>'.
				'<source src="'.$path.$name.'#t=0,5" type="video/mp4"  loop="true">'.
				'متصفحك لا يدعم عرض الفيديو'.
				'</video>'.
				'</a>'.		
    				'<div>'.
    				'</div>'.
    			'</div>';
							
						}
						
							}
							

	?>	
<input id="year_input" name="year_input" style="display:none;" value="0"></input>
<input id="month_input" name="month_input" style="display:none;" value="0"></input>
   				</div>
		</div>
			 </div>
			    </section>
				
				
				
    	</div>
</div>

        
    </main>

    <script src="assets2/js/app.js"></script>
    <script src="assets2/js/theme.js"></script>
	
	
    <script src="assets2/js/jquery-2.1.1.js"></script>
    <script src="assets2/js/jquery.mixitup.min.js"></script>
    <script src="assets2/js/main.js"></script> <!-- Resource jQuery -->

<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>
	
    <footer class="footer pt-5 pb-5 text-center">
        
    <div class="container">
        
          <div class="socials-media">
    
            <ul class="list-unstyled">
              <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-facebook"></i></a></li>
              <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-twitter"></i></a></li>
              <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-instagram"></i></a></li>
                      </ul>
    
          </div>
        
          
    
        </div>
        
    </footer>    
</body>


<script>
$('select').change(function(){
  this.form.submit();
});

</script>

    <!--<script>
$("#date-dropdown").change(function() {
    $("#year_input").val($(this).val());
}).change(); // trigger once if needed
$("#month").change(function() {
    $("#month_input").val($(this).val());
}).change(); // trigger once if needed



</script>-->

</html>
