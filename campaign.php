<?php header('Content-Type: text/html; charset=utf-8')?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">






  <title> Funda of Web IT | Admin Panel</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="slider_style.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">إضافة تفاصيل الحملة:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label style = "position:relative; left:80%; top:2px;"> عنوان الحملة: </label>
                <pre><input required type="text" id="title" name="title" class="form-control" placeholder=""></pre>
            </div>
            <div class="form-group">
                <label style = "position:relative; left:82%; top:2px;">نص الحملة:</label>
                <pre><textarea required style="resize: none;height: 100px; "  type="text" id="text" name="text" class="form-control" placeholder=""></textarea></pre>
            </div>
            <div class="form-group">
                <label style = "position:relative; left:85%; top:2px;">الهاشتاغ:</label>
                <pre><input required type="text" name="hashtag" id="hashtag" class="form-control" placeholder=""></pre>
            </div>
            
         <input type="text" style="display:none;" id="to_edit_id" name="to_edit_id"></input>
        </div>
        <div class="modal-footer">
         
            <button type="submit" name="registerbtn" class="btn btn-primary">حفظ</button> 
			   <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style = "position:relative; left:90%; top:2px;">
              إضافة حملة 
            </button>
  
  </div>

  <div class="card-body">

    <div class="table-responsive">

<?php	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
$conn->set_charset("utf8"); 
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$showRecordPerPage = 5;
	if(isset($_GET['page']) && !empty($_GET['page'])){
		$currentPage = $_GET['page'];
	}else{
		$currentPage = 1;
	}
	$startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
	$totalEmpSQL = "SELECT * FROM campaigns";
	$allEmpResult = mysqli_query($conn, $totalEmpSQL);
	$totalEmployee = mysqli_num_rows($allEmpResult);
	$lastPage = ceil($totalEmployee/$showRecordPerPage);
	$firstPage = 1;
	$nextPage = $currentPage + 1;
	$previousPage = $currentPage - 1;
	$empSQL = "SELECT  campaign_id, campaign_title, campaign_text,campaign_hashtag, campaign_status, created_date
	FROM campaigns LIMIT $startFrom, $showRecordPerPage";
	$empResult = mysqli_query($conn, $empSQL);		
	?>




      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
        
            <th> عنوان الحملة </th>
            <th>نص الحملة </th>
            <th>الهاشتاغ</th>
            <th>الحالة </th>
            <th>تاريخ الإضافة </th>
          </tr>
        </thead>
        <tbody>
    <?php 
		while($emp = mysqli_fetch_assoc($empResult)){
			
		echo '<tr>
			<td style="text-align: right;">'.$emp['campaign_title'].' </td>
            <td style="text-align: right;">'. $emp['campaign_text'].'</td>
            <td style="text-align: right;">'.$emp['campaign_hashtag'].'</td>';
	 if ($emp['campaign_status']==0){
		 echo '<td style="text-align: right;"><label class="switch">
  <input id=chckbx'.$emp['campaign_id'].' type="checkbox" onclick="myFunction('.$emp['campaign_id'].');">
  <span class="slider round"></span>
</label></td>';
	 }
	 else{ echo '<td style="text-align: right;"><label class="switch">
  <input id=chckbx'.$emp['campaign_id'].' type="checkbox" checked onclick="myFunction('.$emp['campaign_id'].');">
  <span class="slider round"></span>
</label></td>'; }
			
			
			
            echo '
			<td style="text-align: right;">'.$emp['created_date'].'</td>
			<td><input type="hidden" name="edit_id" value="">
                    <button  type="button" name="edit_btn" class="btn btn-success" data-toggle="modal" data-target="#addadminprofile" onclick="edit('.$emp['campaign_id'].');"> تعديل</button>
                
            </td>
            <td>
               
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="delete_btn" class="btn btn-danger" onclick="del('.$emp['campaign_id'].');" > حذف </button>
              
            </td>
		</tr>';}
         ?>
        
        </tbody>
      </table>
	 
<nav aria-label="Page navigation">
	  <ul class="pagination">
	  <?php if($currentPage != $firstPage) { ?>
		<li class="page-item">
		  <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
			<span aria-hidden="true">First</span>			
		  </a>
		</li>
		<?php } ?>
		<?php if($currentPage >= 2) { ?>
			<li class="page-item"><a class="page-link" href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
		<?php } ?>
		<li class="page-item active"><a class="page-link" href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>
		<?php if($currentPage != $lastPage) { ?>
			<li class="page-item"><a class="page-link" href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
			<li class="page-item">
			  <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
				<span aria-hidden="true">Last</span>
			  </a>
			</li>
		<?php } ?>
	  </ul>
	</nav>
	


    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');

?>