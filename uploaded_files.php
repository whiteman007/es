<!DOCTYPE html>

<html lang="ar" dir="rtl">


<?php
$files_total=$_GET['t'];
//echo $files_total;
$main_array=array();
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
<!--<form id="cat_form" name="cat_form" action="forms_action.php" method="post">-->

<form id="main_form" name="main_form" action="forms_action.php" method="post" enctype="multipart/form-data">
<div class="panel panel-default">
		<div class="panel-heading"><label for="main_cat">اختر التصنيف الأساسي:
				</label>
				
				<select required name="main_cat" class="form-control" id="main_cat">
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
														<select required id="sub_cat" name="sub_cat" class="form-control">
														<option hidden disabled selected value> -- التصنيفات الثانوية -- </option>
														</select>
												</div>
										
				
		</div>



<?php
					
for ($i=1;$i<=$files_total;$i++)
{
	$f="f".$i;
	
	$file_name=$_GET[$f];
	
	$pieces = explode(".", $file_name);

	$typ=$pieces[1];
	
	
	
	if($typ =="mp4") {

	
	echo ' 		<div class="panel-body" id="'.$i.'">
	<label> الملف '.$i.' : </label><span  id="close'.$i.'" class="close">&nbsp;&times;&nbsp;</span><br/>
				<div class="row">
						<div class="col-sm-2">
								<div class="form-group">
								<input required id="uploaded_file_name'.$i.'" name="uploaded_file_name'.$i.'" style="display:none;" value="'.$file_name.'"></input>
							<label for="uploaded_file'.$i.'"><p> أولوية العرض في الصفحة الرئيسية:</p>
							&nbsp;&nbsp;<input required  type="radio" id="normal_priority'.$i.'" name="priority'.$i.'" value="0">
  <label for="normal_priority">أولوية عادية</label><br>
  <input required type="radio" id="high_priority'.$i.'" name="priority'.$i.'" value="1">
  <label for="high_priority">أولوية عالية</label><br></label>

										<a class="thumbnail thumbnail-button" href="#">
												<video  width="300" height="150" id="uploaded_file'.$i.'" name="uploaded_file'.$i.'"  style="width: 100%;display:block;margin-bottom:7px;" type="video/mp4" controls>
												<source src="uploads/'.$file_name.'"#t=0.1" type="video/mp4" /></video>
										</a>
										<label for="imageupload'.$i.'">صورة العرض:</label>
  <input type="file" id="imageupload'.$i.'" name="imageupload'.$i.'" accept="image/*">
								</div>
						</div>
						<div class="col-sm-10">
								<div class="row">
										<div class="col-sm-4">
												<div class="form-group">
														<span <span class="input-group-text" id="basic-addon1">السنة</span>';?>
<select required id="year<?php echo $i;?>" name = "year<?php echo $i;?>" class="form-control">
	<option hidden disabled selected value> -- اختر السنة -- </option>
	<?php
		$y = date("Y", strtotime("+8 HOURS"));
		for($year = 2015; $y >= $year; $y--){
			echo "<option value = '".$y."'>".$y."</option>";
		}
	?>
</select>


												<?php echo '</div>
										</div>
										<div class="col-sm-4">
												<div class="form-group">
														<span class="input-group-text" id="basic-addon1">الشهر</span>
  
  <select required id="month'.$i.'" name="month'.$i.'"  class="form-control">';?>
    
	
	
	
	<?php $months = array('1' => 'كانون الثاني','2'=>'شباط','3'=>'آذار','4'=>'نيسان','5'=>'أيار','6'=>'حزيران','7'=>'تموز','8'=>'آب','9'=>'أيلول','10'=>'تشرين الأول','11'=>'تشرين الثاني','12'=>'كانون الأول' ); ?>
	<?php echo '<option hidden disabled selected value> -- اختر الشهر -- </option>'; ?>
<?php foreach ($months as $key => $value) { ?>
  <option value="<?php echo $key;?>"><?php echo $value;?></option>
<?php } ?>
</select>
	
	
	
<?php
 echo '</select>

												</div>
										</div>
										<div class="row">
										<div class="col-sm-3">
												<span class="input-group-text" id="basic-addon1">نوع الملف:</span>
														<select required class="form-control" id="type'.$i.'" name="type'.$i.'">
														<option hidden disabled selected value> -- اختر النوع -- </option>
														<option value="4"> فيديو </option>
														<option value="5"> فيديوغراف </option>
														</select>
										</div>
								</div>
								<div class="row">
								<div class="col-sm-11">
								<label for="description'.$i.'">الوصف:</label>
														<input required type="text" class="form-control" id="description'.$i.'" name="description'.$i.'" style="height:100px;">
								</div>
								</div>
								<div class="row">
										<div class="col-sm-6">
												<div class="form-group">
														<label for="search'.$i.'">كلمات البحث:</label>
														<input required type="text" class="form-control" id="search'.$i.'" name="search'.$i.'" style="height:100px;">
														
												</div>
										</div>
										<div class="col-sm-5">
												<div class="form-group">
														<label for="tags'.$i.'">العلامات (tags)</label>
														<input required type="text" class="form-control" id="tags'.$i.'" name="tags'.$i.'" style="height:100px;">
												</div>
										</div>
								</div>
								
						</div>
				</div>
		</div>
</div>
   <div class="panel panel-default">
</div>';
   echo "<br/>";
   echo "<br/>";
	
	
}
				
				
				
				
				
 else {

	echo ' 		<div class="panel-body" id="'.$i.'">
	
<label> الملف '.$i.' : </label><span id="close'.$i.'" class="close">&nbsp;&times;&nbsp;</span><br/>
				<div class="row">
						<div class="col-sm-2">
								<div class="form-group">
								<input required id="uploaded_file_name'.$i.'" name="uploaded_file_name'.$i.'" style="display:none;" value="'.$file_name.'"></input>
								<label for="uploaded_file'.$i.'"><p> أولوية العرض في الصفحة الرئيسية:</p>
							&nbsp;&nbsp;<input required type="radio" id="normal_priority'.$i.'" name="priority'.$i.'" value="0">
  <label for="normal_priority">أولوية عادية</label><br>
  <input  required type="radio" id="high_priority'.$i.'" name="priority'.$i.'" value="1">
  <label for="high_priority">أولوية عالية</label><br></label>
									
										<a class="thumbnail thumbnail-button" href="#">
												<img src="uploads/'.$file_name.'" id="uploaded_file'.$i.'" name="uploaded_file'.$i.'" >
										</a>
								</div>
						</div>
						<div class="col-sm-10">
								<div class="row">
										<div class="col-sm-4">
												<div class="form-group">
														<span class="input-group-text" id="basic-addon1">السنة</span>';?>
<select required id="year<?php echo $i;?>" name = "year<?php echo $i;?>" class="form-control">
	<option hidden disabled selected value> -- اختر السنة -- </option>
	<?php
		$y = date("Y", strtotime("+8 HOURS"));
		for($year = 2015; $y >= $year; $y--){
			echo "<option value = '".$y."'>".$y."</option>";
		}
	?>
</select>


												<?php echo '</div>
										</div>
										<div class="col-sm-4">
												<div class="form-group">
														<span class="input-group-text" id="basic-addon1">الشهر</span>
  
  <select required id="month'.$i.'" name="month'.$i.'"  class="form-control">';?>
    
	
	
	
	<?php $months = array('1' => 'كانون الثاني','2'=>'شباط','3'=>'آذار','4'=>'نيسان','5'=>'أيار','6'=>'حزيران','7'=>'تموز','8'=>'آب','9'=>'أيلول','10'=>'تشرين الأول','11'=>'تشرين الثاني','12'=>'كانون الأول' ); ?>
	<?php echo '<option hidden disabled selected value> -- اختر الشهر -- </option>'; ?>
<?php foreach ($months as $key => $value) { ?>
  <option value="<?php echo $key;?>"><?php echo $value;?></option>
<?php } ?>
</select>
	
	
	
<?php echo '</select>

  
												</div>
										</div>
										<div class="row">
										<div class="col-sm-3">
											<span class="input-group-text" id="basic-addon1">نوع الملف:</span>
														<select  required class="form-control" id="type'.$i.'" name="type'.$i.'">
														<option hidden disabled selected value> -- اختر النوع -- </option>
														<option value="1"> صورة </option>
														<option value="2"> بوستر </option>
														<option value="3"> إنفوغراف </option>
														</select>
										</div>
								</div>
								<div class="row">
								<div class="col-sm-11">
								<label for="description'.$i.'">الوصف:</label>
														<input required type="text" class="form-control" id="description'.$i.'" name="description'.$i.'" style="height:100px;">
								</div>
								</div>
								<div class="row">
										<div class="col-sm-6">
												<div class="form-group">
														<label for="search'.$i.'">كلمات البحث:</label>
														<input required type="text" class="form-control" id="search'.$i.'" name="search'.$i.'" style="height:100px;">
														
												</div>
										</div>
										
										<div class="col-sm-5">
												<div class="form-group">
														<label for="tags'.$i.'">العلامات (tags)</label>
														<input required type="text" class="form-control" id="tags'.$i.'" name="tags'.$i.'" style="height:100px;">
												</div></div>
								</div>
								
						</div>
				</div>
		</div>
</div>
<div class="panel panel-default">
</div>';
   echo "<br/>";
 
	
	
}
				
			
			
}



?>
<input id="deleted" name="deleted" style="display:none;" value="0"></input>
<input id="total" name="total" style="display:none;" value="<?php echo $files_total;?>"></input>
<button type="submit" class="btn btn-primary btn-block mb-4">حفظ</button>
</form>

<div class="input-group mb-3">
</div>


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


<script>
var arr=[];
$("span.close").click(function() {
	arr.push($(this).parent().attr('id'));
    $(this).parent().remove();
	$("#deleted").val(arr);
});

</script>


</body>
</html>



