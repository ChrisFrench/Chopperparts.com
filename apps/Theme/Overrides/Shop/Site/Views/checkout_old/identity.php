<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-top paddingBottom">
        <div id="loaderFull" style="display: none;"></div>
		  <h2>
		    Checkout 
		</h2>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php echo $this->renderView('Shop/Site/Views::checkout/login.php'); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php echo $this->renderView('Shop/Site/Views::checkout/register.php'); ?>
        </div>            
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 checkoutSidebar  col-top">
            <?php echo $this->renderView('Shop/Site/Views::checkout/cart.php'); ?>
        </div>            
</div>
 


<script type="text/javascript">
	ga('send', 'event', 'Shopping', 'click', 'checkout login page');     // Send data using an event.
	ga('ec:setAction','checkout', {'step': 1});
</script>