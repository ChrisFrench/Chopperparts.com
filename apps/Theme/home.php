<!DOCTYPE html>
<html lang="en" class="default <?php echo @$html_class; ?>" >
<?php echo $this->renderView('Theme/Views::common/head.php'); ?>
<body role="document">
 <!--Start class site-->
    <div class="tz-site" role="main">
<?php echo $this->renderView('Theme/Views::common/header.php'); ?>

	<?php echo $this->renderView('Theme/Views::system-messages.php'); ?>
     <tmpl type="view" />
    
        <!--/FOOTER -->
   
    <!--/PAGE -->
    
  
	 <?php echo $this->renderView('Theme/Views::common/footer.php'); ?>
	 
	 

    
	 	 <?php if ($this->app->get('DEBUG') ) { ?>
	<div class="footer-bottom col-lg-12 col-md-12 col-sm-12 col-xs-12">
		    <div class="c">
		        <div class="stats list-group">
		            <h4>Stats</h4>
		            <div class="list-group-item" >
		                <?php echo \Base::instance()->format('Page rendered in {0} msecs / Memory usage {1} KB',round(1e3*(microtime(TRUE)-$TIME),2),round(memory_get_usage(TRUE)/1e3,1)); ?>
		            </div>
		        </div>
		        <div style="word-wrap:break-word;">
		        <tmpl type="system.loaded_views" />
				</div>		        
		    </div>
	</div>
<?php } ?>	
	 
</div>
</body>
</html>
