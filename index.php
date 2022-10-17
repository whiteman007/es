<!DOCTYPE html>

<html lang="ar" dir="rtl">

<?php include("./connection.php"); ?>



<?php
$camp=0;
$title="";
$text="";
$hashtag="";

$sql = "SELECT campaign_title, campaign_text, campaign_hashtag, campaign_status FROM campaigns ORDER BY campaign_id DESC LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row['campaign_status']==1){
	$camp=1;
	$title=$row['campaign_title'];
	$text=$row['campaign_text'];
	$hashtag=$row['campaign_hashtag'];
	
	}
  }
} else {
  echo "0 results";
}






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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/st.action-panel.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<style>
.mobile-fab-tip {
	position: fixed;
	right: 100px;
	padding:0px 0.5rem;
	text-align: right;
	background-color: #323232;
	border-radius: 2px;
	color: #FFF;
	width:auto;
	font-size: medium;
}
</style>
</head>

<body>

    <?php include("./header_nav.php"); ?>
    <main role="main">
        <br/>
    
    <section class="mt-4 mb-5">
    <div class="container mb-4">
    	<div class="row">
    		<nav class="navbar navbar-expand-lg navbar-light bg-white pl-2 pr-2">
    		<div class="collapse navbar-collapse" id="navbarsExplore">
    			<ul class="navbar-nav">
    				<li class="nav-item">
			
    			</ul>
    		</div>
    		</nav>
    	</div>
    </div>
	<br/><br/><br/>
    <div class="container-fluid">
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
	$totalEmpSQL = "SELECT * FROM all_files order by RAND()";
	$allEmpResult = mysqli_query($conn, $totalEmpSQL);
	$totalEmployee = mysqli_num_rows($allEmpResult);
	$lastPage = ceil($totalEmployee/$showRecordPerPage);
	$firstPage = 1;
	$nextPage = $currentPage + 1;
	$previousPage = $currentPage - 1;
	$empSQL = "SELECT file_id, file_path, file_name, type, cat_id, final_thumbnail
	FROM `all_files` order by priority DESC LIMIT $startFrom, $showRecordPerPage";
	$empResult = mysqli_query($conn, $empSQL);								
	if(mysqli_fetch_assoc($empResult)==0){$lastPage="1";}				
				while($row = mysqli_fetch_assoc($empResult)){	
							$file_id=$row["file_id"];
							$path=$row["file_path"];					
							$name = $row["file_name"];
							$typ= $row["type"];
							$category_id=$row["cat_id"];				
							$thumb=$row['final_thumbnail'];
							if ($typ!="video" && $typ!="videographic"){
							$sql2="SELECT arabic_name FROM sub_categories where category_id=".(int)$category_id;

							$res=$conn->query($sql2);
							if($res->num_rows>0){
								while($r=$res->fetch_assoc()){
								$a_name=$r["arabic_name"];
								//echo $a_name;
								}
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
						else{
				
				echo'<div class="card card-pin">'.
							'<img class="card-img" src='.$thumb.' width="320" height="240">'.
							'<div class="overlay">'.
							'<h2 class="card-title title">'.$a_name.'</h2>'.
							'<div class="more">'.
    						'<a href="video.php?file='.$file_id.'">'.
    						'<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>  </a>'.
							'</div>'.
							'</div>'.
							'</div>';
							
						}
						
							}
							
					
					
						
						


?>
    				
    		</div>
    	</div>
    </div>
	

    <?php include("./page_nav.php"); ?>
	
    </section>
        
    </main>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/theme.js"></script>
    
    <footer class="footer pt-5 pb-5 text-center">
        
    <div class="container">
        
          
					  <?php $conn->close(); ?>
    
        
          
    
        </div>
        
    </footer>    
	<?php if($camp==1){
		echo '<div class="st-actionContainer right-bottom" style="display: block;">
	<div class="st-panel">
		<div class="st-panel-header"><i class="fa fa-bars" aria-hidden="true"></i>'.$title.' </div>
		<div class="st-panel-contents">
			'.$text.'
			<br/>
			'.$hashtag.'
		</div>';
		
	}else{
		echo '<div class="st-actionContainer right-bottom" style="display: none;">
	<div class="st-panel">
		<div class="st-panel-header"><i class="fa fa-bars" aria-hidden="true"></i> </div>
		<div class="st-panel-contents">
			
		</div>';
	}?>

		<div class="grid">
				
			</div>
	</div>
	<div class="st-btn-container right-bottom">
		<div class="st-button-main"><i class="fa fa-bars" aria-hidden="true"></i>	<a href="#" class="btn-floating mobile-fab-tip">شارك بالحملة</a></div>
	</div>
</div>

</div>

</body>

<script src="js/st.action-panel.js"></script>
<script>
$(document).ready(function(){
	$('st-actionContainer').launchBtn( { openDuration: 500, closeDuration: 300 } );
});
</script>

    
</html>
