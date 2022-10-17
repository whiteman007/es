<?php
$main_cat_array=array();
$sub_cat_array=array();
$mainId_array=array();
$subId_array=array();

for ($i=1;$i<=$files_total;$i++)
{
$main_cat_array[$i]="#main_cat".$i;
$sub_cat_array[$i]="#sub_cat".$i;
$mainId_array[$i]="mainId".$i;
$subId_array[$i]="subId".$i;
}


?>





<script type="text/javascript">

<?php for ($i=1; $i<=$files_total; $i++){

   echo 'var main='.$main_cat_array[$i];
   
   echo '$(document).ready(function(){
      
      $(main).on("change",function(){';
		  
        echo 'var '.$mainId_array[$i].'  = $(this).val()';
        
		echo '$.ajax({
          url :"action.php",
          type:"POST",
          cache:false,
          data:{'.$mainId_array[$i].':'.$mainId_array[$i].'},';
          echo 'success:function(data){
            $("'.$sub_cat_array[$i].'").html(data);
          }
        });			
      });

      
      $("'.$sub_cat_array[$i].'").on("change", function(){';
		  
        echo 'var ' . $subId_array[$i].'= $(this).val();

        $.ajax({
          url :"action.php",
          type:"POST",
          cache:false,
          data:{'.$subId_array[$i].':'.$subId_array[$i].'}
        });
      });
    });';
}
	?>
  </script>