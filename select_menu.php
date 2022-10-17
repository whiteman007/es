<!DOCTYPE html>

<html lang="ar" dir="rtl">


<?php
include('db_config.php');
?>


<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <title>CodePen - A Pen by Thomas Bormans</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<!-- partial:index.partial.html -->
<form action="" method="post">
<div class="panel panel-default">
		<div class="panel-heading"><label for="main_cat">اختر التصنيف الأساسي:
				</label>
				
				<select name="main_cat" class="form-control" id="main_cat">
				<option hidden disabled selected value> -- التصنيفات الأساسية -- </option>


				
<?php 
					$query = "SELECT * FROM main_categories";
					$result = $con->query($query);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<option value="'.$row['category_id'].'">'.$row['arabic_name'].'</option>';
						}
					}else{
						echo '<option value="">Category not available</option>'; 
					}
					?>
				</select>
     
					
												<div class="panel-heading">
														<select id="sub_cat" class="form-control">
														<option hidden disabled selected value> -- التصنيفات الثانوية -- </option>
														</select>
												</div>
										
				
		</div>
		<div class="panel-body">
				<div class="row">
						<div class="col-sm-2">
								<div class="form-group">
										<label for="personidphoto">ID Photo:</label>
										<a class="thumbnail thumbnail-button" href="#">
												<img src="http://placehold.it/108x108" id="personidphoto">
										</a>
								</div>
						</div>
						<div class="col-sm-10">
								<div class="row">
										<div class="col-sm-4">
												<div class="form-group">
														<span class="input-group-text" id="basic-addon1">السنة</span>
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
										<div class="col-sm-4">
												<div class="form-group">
														<span class="input-group-text" id="basic-addon1">الشهر</span>
  
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
										<div class="row">
									
								</div>
								<div class="row">
										<div class="col-sm-6">
												<div class="form-group">
														<label for="gender">Gender:</label>
														<input type="text" class="form-control" id="gender">
												</div>
										</div>
										<div class="col-sm-6">
												<div class="form-group">
														<label for="medical">Notable medical condition(s):</label>
														<input type="text" class="form-control" id="medical">
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>
</div>
   </form>

   <script type="text/javascript">
   var main="#main_cat";
    $(document).ready(function(){
      
      $(main).on("change",function(){
		  
        var mainId = $(this).val();
        $.ajax({
          url :"action.php",
          type:"POST",
          cache:false,
          data:{mainId:mainId},
          success:function(data){
            $("#sub_cat").html(data);
          }
        });			
      });

      
      $("#sub_cat").on("change", function(){
		  
        var subId = $(this).val();

        $.ajax({
          url :"action.php",
          type:"POST",
          cache:false,
          data:{subId:subId}
        });
      });
    });
  </script>
<!-- partial -->
  
</body>

</html>
