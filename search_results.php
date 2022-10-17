<!DOCTYPE html>

<html lang="ar" dir="rtl">


<?php
//php_mysql_connection_and_get_categories
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";
$search_query="";



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
<?php
include("./include.php");
					

													
							// display search result count to user
							//echo '<br /><div class="right"><b><u>'.$result_count2.'</u></b> results found</div>';
							//echo 'Your search for <i>'.$display_words.'</i> <hr /><br />';


							// display all the search results to the user
							//while ($row2 = mysqli_fetch_assoc($query2)){
								
								//echo '<img src="'.$row2['file_path'].$row2['file_name'].'"/>' ;
							//echo '<script type="text/javascript">location.href = "search_results.php";</script>';
							
							
						//	}
							

							
						//}
						//else
							//echo 'No results found. Please search something else.';
					//}
					//else
						//echo '';
				?>
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
<script>
      function validateForm(e) {
          var uname=document.getElementById("search-input").value;
          if (uname==""){
              alert("الرجاء إدخال كلمة البحث");
              return false;
          }
      }
    </script>
<form class="bd-search hidden-sm-down" onSubmit="return validateForm()" action="search_results.php">
    			<input type="text" class="form-control bg-graylight border-0 font-weight-bold" id="search-input" type="text" name="k" placeholder="ابحث عن..." autocomplete="off">
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
    <div class="container-fluid">
    	<div class="row">
		
		
<?php
										
	$showRecordPerPage = 10;
	if(isset($_GET['page']) && !empty($_GET['page'])){
		$currentPage = $_GET['page'];
	}else{
		$currentPage = 1;
	}
	$startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;	
				//$conn = new mysqli($servername, $username, $password, $dbname);
//mysqli_set_charset($conn,"utf8");


// Check connection
//if ($conn->connect_error) {
  //die("Connection failed: " . $conn->connect_error);
//}

//echo "Connected successfully";
// CHECK TO SEE IF THE KEYWORDS WERE PROVIDED
					if (isset($_GET['k']) && $_GET['k'] != ''){
						
						// save the keywords from the url
						$k = trim($_GET['k']);

// create a base query and words string
						$condition  = "";
						$display_words = "";

						// seperate each of the keywords
						$keywords = explode(' ', $k); 
						foreach($keywords as $word){
							$condition  .= " WHERE tags LIKE '%".$word."%' OR description LIKE '%".$word."%'OR caption LIKE '%".$word."%' OR";
							$display_words .= $word." ";
						}
						$condition  = substr($condition , 0, strlen($condition) - 3);
						
						
						
					$showTable = "SHOW TABLES from website_db";
$getData = mysqli_query($conn, $showTable);
while ($row = mysqli_fetch_row($getData)) {
$table = $row[0];   
$string=$table[0];
if (is_numeric($string[0])){
//echo $table."<br/>"; 			
$select="SELECT * FROM ". $table.$condition." UNION ";
//$select="SELECT file_id, file_path FROM ". $table." UNION ";
$search_query.=$select;
}
else
	continue;
}
	
						
			$totalEmpSQL  = substr($search_query , 0, strlen($search_query ) - 7);			
					//print_r($totalEmpSQL);	
						
						$query2 = mysqli_query($conn, $totalEmpSQL );
						$result_count2 = mysqli_num_rows($query2);
						
						// check to see if any results were returned
						if ($result_count2 > 0){

			//echo "test";
	//$totalEmpSQL = "SELECT * FROM all_files where type='1' or type='4' order by RAND()";
	//$totalEmpSQL = "SELECT * FROM all_files order by RAND()";
	$allEmpResult = mysqli_query($conn, $totalEmpSQL);
	$totalEmployee = mysqli_num_rows($allEmpResult);
	//print_r($totalEmployee);
						}
												else{echo "<center><p>لم يتم العثور على أي نتيجة</p></center>";}
	$firstPage = 1;
	$nextPage = $currentPage + 1;
	if(isset($totalEmployee))
	$lastPage = ceil($totalEmployee/$showRecordPerPage);
	else
		$lastPage=$firstPage;


	$previousPage = $currentPage - 1;
	$empSQL = $totalEmpSQL." LIMIT $startFrom, $showRecordPerPage";
	$empResult = mysqli_query($conn, $empSQL);								
					
				while($row = mysqli_fetch_assoc($empResult)){	
							$file_id=$row["file_id"];
							$path=$row["file_path"];					
							$name = $row["file_name"];
							$typ= $row["type"];
							$desc=$row["description"];
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
							echo'<br/><div class="card-columns">'.
							'<div class="card card-pin"><img class="card-img" src='.$path.$name.' >'.
							'<div class="overlay">'.
							'<h2 class="card-title title">'.$a_name.'</h2>'.
							'<div class="more">'.
    						'<a href="post.php?file='.$file_id.'">'.
    						'<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>'.
							'</div>'.
							'</div>'.
							'</div>'.
							'<div class="card card-pin"><p>'. $desc.'</p></div>'.
							'<div class="card card-pin"><p></p></div>'.
							'<div class="card card-pin"><p>'. $name.'</p></div></div><!--<hr style="width:50%;">-->';
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
						
						
					}
					
					
							
					
					
						
						


?>
    				
    		</div>
    	</div>
    </div>
	
<div class="row justify-content-center mt-5">
	 
	 
      
      <nav aria-label="Page navigation">
	  <ul class="pagination">
	  <?php if($currentPage != $firstPage) { ?>
		<li class="page-item">
		  <a class="page-link" href="?k=<?php echo $k ?>&page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
			الصفحة الأولى			
		  </a>
		</li>
		<?php } ?>
		
		<?php if($currentPage > 2) { ?>
			<li class="page-item"><a class="page-link" href="?k=<?php echo $k ?>&page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
		<?php } ?>
		<li class="page-item active"><a class="page-link" href="?k=<?php echo $k ?>&page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>
		<?php if($currentPage != $lastPage ) { ?>
			<li class="page-item"><a class="page-link" href="?k=<?php echo $k ?>&page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
			<li class="page-item">
			  <a class="page-link" href="?k=<?php echo $k ?>&page=<?php echo $lastPage ?>" aria-label="Next">
				الصفحة الأخيرة
			  </a>
			</li>
		<?php } ?>
		
		
	  </ul>
	</nav> 
        
	
              
    </div>        
	
	
	
	
	
    </div>
	


	
    </section>
        
    </main>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/theme.js"></script>
    
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
        
    </footer>    
</body>
    
</html>
