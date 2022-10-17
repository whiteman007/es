<!DOCTYPE html>
<html lang="ar" dir="rtl">
<?php
//php_mysql_connection_and_get_categories
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$file=$_GET["file"];
  
 $pieces = explode("-", $file);
$cat=$pieces[0]; 



$pcs=explode(".", $cat);
$main=$pcs[1];
$sub=$pcs[2];
 
 
 
// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>---</title>
	<link rel="shortcut icon" href="assets/img/logo.png">
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/theme.css">
	
	
	

</head>

<body>

	<?php
	//echo $file;
	$category="";
$sql = "SELECT cat_id, file_path FROM ".$sub."_files where file_id='".$file."'";
$result = $conn->query($sql);
//echo "Connected successfully";
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
	$cat_id=$row["cat_id"];	
 //echo "category=".$cat_id;	
	$file_path = $row["file_path"];
	
	$category=$cat_id;
 //echo $file;
 //echo "<br/>";
 //echo $file_path;
}
}

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
    <br/>
    <section class="bg-gray200 pt-5 pb-5">
    <div class="container">
    	<div class="row justify-content-center">
    		<div class="col-md-7">
    			<article class="card">
    			<img class="card-img-top mb-2" src=<?php echo '"'.$file_path.$file.'.jpg"' ?> alt="Card image">
    			<div class="card-body">
    				<h1 class="card-title display-4" style="text-align:right;">
					<?php 
					
					$sql_cat = "SELECT arabic_name, main_category  FROM sub_categories where category_id='".$category."'";
					$result = $conn->query($sql_cat);
					//echo "Connected successfully";
					if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
					$sub_arb_name=$row["arabic_name"];	
						//echo "category=".$cat_id;	
						$main_cat = $row["main_category"];
						$sql_main_cat = "SELECT arabic_name FROM main_categories where category_id='".$main_cat."'";
					$result = $conn->query($sql_main_cat);
					//echo "Connected successfully";
					if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
					$main_arb_name=$row["arabic_name"];	
					}
					}
	
					}
					}
					
					echo $main_arb_name." - ".$sub_arb_name."</h1>";
					$sql_desc = "SELECT description FROM ".$sub."_files where file_id='".$file."'";
					$result = $conn->query($sql_desc);
					//echo "Connected successfully";
					if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						
					$desc=$row["description"];
					echo "<br/>";
					echo '<p >'.$desc.'</p>';
					
					}
					}
					
					?>
    			    </h1>
    				<p style="text-align:right;">
					<?php
					echo "<br/><br/>";
					?>
					</p>
    					
    				<center><small class="d-block"><a class="btn btn-sm btn-gray200" href=<?php echo '"'.$file_path.$file.'.jpg"' ?> download> تحميل الصورة </a></small></center>
    				<!-- Begin Comments -replace demowebsite with your own id
                    ================================================== -->
    				<!--<div id="comments" class="mt-4">
    					<div id="disqus_thread">
    					</div>
    					<script type="text/javascript">
                            var disqus_shortname = 'demowebsite'; 
                            var disqus_developer = 0;
                            (function() {
                                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                dsq.src = window.location.protocol + '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();
                        </script>
    					<noscript>
    					Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
    					</noscript>
    				</div>-->
    				<!--End Comments
                    ================================================== -->
    			</div>
    			</article>
    		</div>
    	</div>
    </div>
	
	
	
    <div class="container-fluid mt-5">
    	<div class="row">
    		<h5 class="font-weight-bold">شاهد المزيد:</h5>
			<div class="card-columns">
    		<?php
	
	$sql2 = "SELECT * FROM ". $sub."_files "." where file_id <>'".$file."' order by RAND() LIMIT 20";
					$result = $conn->query($sql2);
					if ($result->num_rows > 0) {
					// output data of each row
						while($row = $result->fetch_assoc()) {
							$file_id=$row["file_id"];
							$path=$row["file_path"];					
							$name = $row["file_name"];

							$typ= $row["type"];
							if ($typ!="video" || $typ!="videographic" ){
								
							$sql2="SELECT arabic_name FROM sub_categories where category_id=".(int)$category;

							$res=$conn->query($sql2);
							if($res->num_rows>0){
								while($r=$res->fetch_assoc()){
								$a_name=$r["arabic_name"];
								//echo $a_name;
								}

							echo'<div class="card card-pin">'.
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
							}
						else{
							echo '<div>'.
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
					

else {
  //echo "0 results";
}
$conn->close();
						
					
					
	
	?>
			
			
    		</div>
    	</div>
    </div>
	<div>
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
    
          </div>
        
            
    
        </div>
        
    </footer>    
</body>
    
</html>
