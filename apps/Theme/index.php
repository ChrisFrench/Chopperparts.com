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
	 
	 

    
	 
	 
</div>








    
    
</body>
</html>
