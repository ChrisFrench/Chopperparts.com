<ol class="breadcrumb row ">
	<li><a href="./shop">Shop</a></li>
  
   <li> Something went wrong. </a></li>
</ol>

<script charset="utf-8" type="text/javascript">
<?php echo $this->renderView('Theme/Views::common/richrevelance.php'); ?>
 
  // here's an example requesting recommendations for 3 page areas
  R3_COMMON.addPlacementType('error_page.rr1');
  R3_COMMON.addPlacementType('error_page.rr2');
  R3_COMMON.addPlacementType('error_page.rr3');
 
  var R3_ERROR = new r3_error();
 
  r3();
 
</script>



<div class="row paddingBottom">
	<div class="col-xs-12 text-center">
			<h3> <i class="icon-exclamation"></i> Oops! Something went wrong. ... </h3>
			<p>Search below or go back to our <a href="/">homepage</a> </p>
			
			<form id="search_form" action="/search" method="post" class="form-inline"> 
					<input type="text" class="form-control" name="q" value="" />
					<button class="btn btn-primary"> <i class="glyphicon x05 glyphicon-search"></i> Search</button>
			</form>

</div>
</div>
<!-- Page Content Container -->