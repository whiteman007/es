<div class="row justify-content-center mt-5">
	 
	 
      
        
        <nav aria-label="Page navigation">
	  <ul class="pagination">
	  <?php if($currentPage != $firstPage) { ?>
		<li class="page-item">
		  <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
			الصفحة الأولى			
		  </a>
		</li>
		<?php } ?>
		
		<?php if($currentPage > 2) { ?>
			<li class="page-item"><a class="page-link" href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
		<?php } ?>
		<li class="page-item active"><a class="page-link" href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>
		<?php if($currentPage != $lastPage ) { ?>
			<li class="page-item"><a class="page-link" href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
			<li class="page-item">
			  <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
				الصفحة الأخيرة
			  </a>
			</li>
		<?php } ?>
		
		
	  </ul>
	</nav>
	
              
    </div>