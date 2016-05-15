<ol class="breadcrumb row">
	<li><a href="./shop">Shop</a></li>
  
   <li><a href="/newitems">New Items</a>
	</li>
</ol>


<?php $base = \Dsc\Url::full(false); $activeVechile =  \Dsc\System::instance()->get('session')->get('activeVehicle'); ?>	


	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingTop">
	<div class="row">
	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            <div class="filter-bar ">
	            	
		            <h3>New Items</h3>
	            	

	            <?php if ($activeVechile && empty($category->disableymm)) : ?>	
	            	<?php $universals = $state->get('filter.universal'); 
	            	if(!empty($universals) && $universals == 'yes') : ?>	
	            		<div class="alert alert-success">
						Showing new and universal products that fit your:<strong> <?php echo $activeVechile['title'];?> </strong>
						</div>
	            		<?php else :?>            	
						<div class="alert alert-success">
						Showing new items that fit your:<strong> <?php echo $activeVechile['title'];?> </strong>
						</div>
							<?php endif; ?>	
	            	<?php endif; ?>	
	    

	            </div>
	            

</div>
	      </div>
	   
	   <div class="paddingBottom">
	      
		  
		    	<?php echo $this->renderView('Shop/Site/Views::newitems/grid.php'); ?>
		  
	  </div> 
	</div>
