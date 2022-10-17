<?php

//$typ=$_POST['type_id'];

//echo $typ;

$ref= $_SERVER['HTTP_REFERER'];  
//echo $ref."<br/>";

//var_dump(parse_url($ref));
$url=parse_url($ref);
//print_r($url);
$query=$url['query'];
//echo $query."<br/>";

parse_str($query,$str);
//print_r($str);
if(isset($str['cat'])){$cat=$str['cat'];}
//echo $cat."<br/>";
if(isset($str['m'])){$m=$str['m'];}
//echo $m."<br/>";
if(isset($str['y'])){$y=$str['y'];} //echo $y."<br/>";}

if(isset($str['t'])){$t=$str['t'];}
//echo $t."<br/>";

if ($_POST['year_input']!=0){
	$y=$_POST['year_input']; //echo $y."1<br/>";
	}
//if(isset($_POST['year']) ){
//$y=$_POST['year'];
//echo $y."2<br/>";
//}
if($_POST['month_input']!=0){$m=$_POST['month_input'];}
//if(isset($_POST['month'])){
//$m=$_POST['month'];
//echo $m."<br/>";
//}


if($_POST['type_input']!="null"){$t=$_POST['type_input'];}
if(isset($_POST['type_id'])){
$t=$_POST['type_id'];
//echo $t."<br/>";
}




$link="category.php?cat=".$cat;
//echo $link."<br/>";

if(isset($y)){$link=$link."&y=".$y;}
if(isset($m)){$link=$link."&m=".$m;}
if(isset($t) && $t!=""){

//echo $link."<br/>";



switch ($t) {
  case 0:
    $link=$link."&t=".$t;
    break;
  case 1:
   $link=$link."&t=".$t;
    break;
  case 2:
    $link=$link."&t=".$t;
    break;
	case 3:
    $link=$link."&t=".$t;
	break;
	case 4:
    $link=$link."&t=".$t;
	break;
	 case 5:
    $link=$link."&t=".$t;
    break;
	case 6:
    $link=$link."&t=".$t;
    break;
	case 7:
    $link=$link."&t=".$t;
    break;
  default:
    $link="category.php?cat=".$cat;
	
	//$totalEmpSQL = "SELECT * FROM ". $sub."_files order by RAND()";
	
	//$empSQL = "SELECT file_id, file_path, file_name, type, cat_id FROM ". $sub."_files LIMIT $startFrom, $showRecordPerPage";
}	

}
//echo $link;
echo ("<script LANGUAGE='JavaScript'>
window.location.href='".$link."';
</script>");




//$temp= explode('cat=',$ref);
//$tc=explode('&',$temp[1]);
//$cat=$tc[0];
//echo $cat."<br/>";


//$tempm= explode('m=',$ref);
//$tm=explode('&',$tempm[1]);
//$m=$tm[0];
//if (empty($m)){$m=$tempm[1];}
//echo $m."<br/>";
//echo $tempm[1];

//$tempy= explode('y=',$ref);
//$ty=explode('&',$tempy[1]);
//$y=$ty[0];
//echo $y."<br/>";


//$tempt= explode('&t=',$ref);
//$tt=explode('&',$tempt[1]);
//$t=$tempt[1];
//echo $t."<br/>";





//echo $link."<br/>";




//print_r($temp);

//$old = $temp[0];
//echo $old."<br/>";		


//$new=$old."m=".$year;
//echo $new."<br/>";
	


?>