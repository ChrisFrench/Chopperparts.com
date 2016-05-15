<ol class="breadcrumb row ">
	<li><a href="./shop">Shop</a></li>
  
   <li> Page Not Found</a></li>
</ol>
<script charset="utf-8" type="text/javascript">
<?php echo $this->renderView('Theme/Views::common/richrevelance.php'); ?>
 
  // here's an example requesting recommendations for 3 page areas
  R3_COMMON.addPlacementType('error_page.rr1');

 
  var R3_ERROR = new r3_error();
 
  r3();
 
</script>


<div class="row paddingBottom">
	<div class="col-xs-12 text-center">
			<h3> <i class="icon-exclamation"></i> Oops! We couldn't find the page you're looking for... </h3>
			<p>Search below or go back to our <a href="/">homepage</a> </p>
			
			
		
​
			<?php   $f3 = \Base::instance();
			        //fixing google base links
			     
			        	$path = $f3->hive()['PATH'];
			        	
			    
        
        ?>
        
        
        <h4>Are these products what you are looking for?</h4>
        <?php  

        $q = str_replace(['-', '/', '_','%20'], [' ', '', ' ', ' '], substr($path, strrpos($path, '/') + 1));

        $products_model = new \RallySport\Models\SearchProducts;
         
        
                
        $products_model->setState('filter.keyword', $q);
        $products_model->setState('is.search', true);
        
        $products_model->setParam('limit', 5);
         
        
        $paginated = $products_model->paginate();
        $state = $products_model->getState();
         
                 
        \Base::instance()->set('paginated', $paginated );

        \Base::instance()->set('terms', $q );
        \Base::instance()->set('comparable', false );
        \Base::instance()->set('state', $products_model->getState());
        
        
     
        echo $this->renderLayout('RallySport/Site/Views::search/404.php');
        ?>
     <script charset="utf-8" type="text/javascript"> rr_flush_onload();</script>
        
			
			
			
			
			

</div>
</div>
<!-- Page Content Container -->