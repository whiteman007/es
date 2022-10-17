<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";
$string="";
$tbls="";
$tbl1="";
$condition="";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");


$showTable = "SHOW TABLES from website_db";
$i=0;
$getData = mysqli_query($conn, $showTable);
while ($row = mysqli_fetch_row($getData)) {
	$i++;
	if ($i==1){
		$tbl1="SELECT file_id, file_path FROM ".$row[0];
		//$tbl1_nm=$row[0];
		//echo $tbl1."<br/>";
		continue;
	}
	else{
    $table_name=$row[0];
	if (is_numeric($table_name[0])){
	$names="SELECT file_id, file_path FROM ".$table_name;
	$string.=$names." UNION ";
	//$tbls.=$table_name." , ";	
	//$condition.=$table_name.".description LIKE 'wt' and ";
	}
    }
	
}
$string.=$tbl1;
$sql=$string;
//$tbls.=$tbl1_nm;
//$condition.=$table_name.".description LIKE 'wt' ";
//$sql="SELECT ".$string." FROM ".$tbls;//." WHERE ".$condition;
echo $sql;
$res = mysqli_query($conn, $sql);
if (!$res){
      die ("Database connection failed!");
	  print_r($res);
}
while ($rows = mysqli_fetch_row($res)) {
print_r($rows); 
echo"test";
   }
?>