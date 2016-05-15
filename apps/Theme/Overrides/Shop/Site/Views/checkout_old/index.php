<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-top paddingBottom">
        <div id="loaderFull" style="display: none;"></div>
		  <h2>
		    Checkout 
		    <?php if(empty($this->auth->getIdentity()->id)) : ?><div class="pull-right"><a class="btn btn-link fgBlue " role="button" data-toggle="collapse" href="#checkout-login" aria-expanded="false" aria-controls="collapseExample" >Returning?</a> <a class="btn btn-primary pull-right" role="button" data-toggle="collapse" href="#checkout-login" aria-expanded="false" aria-controls="collapseExample">
                 Sign in
                </a></div>
            <?php endif;?>
		</h2>

		
			<?php if(empty($this->auth->getIdentity()->id)) : ?>
		
			<div id="checkout-login" class="checkout-form collapse" >
	        <div class="row">
		            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		            <div class="well well-sm">
					                <form action="./login" method="post" class="form" role="form">
					        
						                    <div class="input-group form-group">
						                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						                        <input name="login-username" type="email" class="form-control" placeholder="E-Mail Address" required />
						                    </div>
						                    <div class="input-group form-group">
						                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						                        <input name="login-password" type="password" class="form-control" placeholder="Password" required no-validation="true"/>
						                    </div>            
						                    
						                    <div class="form-group form-group">    
						                        <button class="btn btn-default custom-button btn-lg" type="submit">Sign In</button>
						                        <?php \Dsc\System::instance()->get('session')->set('site.login.redirect', '/shop/checkout');
						                        \Dsc\System::instance()->get( 'session' )->set( 'site.login.failed.redirect', '/shop/checkout' );
						                        ?>
						                    <a class="btn btn-link fgblue" style="color:#1287ff;" href="./user/forgot-password">Forgot your password?</a>
						                    </div>
					                    
					                </form>
					                </div>
		            </div>
                </div>
                
            </div>
			<?php endif; ?>

			<form autocomplete="on" action="./shop/checkout/submit" method="POST"  name="checkout-payment" id="checkout-payment-form" >
			         
			            <div id="checkout-register" class="checkout-form">

                    
                    				<legend>
                    					<small>Email</small>
                    				</legend>
                  		<?php if(empty($this->auth->getIdentity()->id)) : ?>
                    					<div  class="form-group">
                    					<input type="email"
                    							name="email_address" id="email_address" class="form-control"
                    							placeholder="Email Address" x-autocompletetype="email"
                    							autocomplete="email" value="<?php echo $cart->get('email',''); ?>" required />
                    					</div>
                   		  <?php else : ?>
                   		  <div  class="form-group">
                    					<input type="email"
                    							name="email_address" id="email_address" class="form-control"
                    							placeholder="Email Address" x-autocompletetype="email"
                    							autocomplete="email" value="<?php echo $this->auth->getIdentity()->email ;?>" required />
                    		</div>
			            <?php endif; ?>
                   		 </div>
                   		
			            <?php echo $this->renderView('Shop/Site/Views::checkout/shipping_forms.php'); ?>
			            <?php echo $this->renderView('Shop/Site/Views::checkout/payment_forms.php'); ?>
			</form>              
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 checkoutSidebar  col-top">
            <?php echo $this->renderView('Shop/Site/Views::checkout/cart.php'); ?>
        </div>            
</div>

<script type="text/javascript">
			
		<?php foreach ($cart->items as $item) { ?>	

			ga('ec:addProduct', {            // Provide product details in an impressionFieldObject.
				'id': '<?php echo \Dsc\ArrayHelper::get($item, 'model_number'); ?>',                   // Product ID (string).
				'name': '<?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?>', // Product name (string).
				'price': '<?php echo $cart->calcItemSubtotal( $item ); ?>',
				'quantity': '<?php echo \Dsc\ArrayHelper::get($item, 'quantity'); ?>',
				'category': '<?php echo \Dsc\ArrayHelper::get($item, 'product.categories.0.title'); ?>',   // Product category (string).
				'brand': '<?php echo \Dsc\ArrayHelper::get($item, 'product.manufacturer.title'); ?>',                // Product brand (string).
			});
		<?php } ?>

ga('ec:setAction','checkout', {'step': 2});
ga('send', 'event', 'Shopping', 'click', 'checkout page');     // Send data using an event.




var CheckoutTracking = {
        trackClicks : function() {
            jQuery('input, select').on('change', function(){
                var el = jQuery(this);
                var action = 'changed: ' + el.attr('name');
                var value = el.val();
                
                if (action) {
                    var form_data = [{
                        name: "action",
                        value: action
                    }, {
                        name: "value",
                        value: value
                    }];
                    
                    var request = jQuery.ajax({
                        type: 'post', 
                        url: './shop/checkout/track',
                        data: form_data
                    });
                }
            });
            $(document).on("change", ".shippingmethod", function() {
            	 var el = jQuery(this);
                 var action = 'Selected : ' + el.attr('name');
                 var value = el.val();
                 
                 if (action) {
                     var form_data = [{
                         name: "action",
                         value: action
                     }, {
                         name: "value",
                         value: value
                     }];
                     
                     var request = jQuery.ajax({
                         type: 'post', 
                         url: './shop/checkout/track',
                         data: form_data
                     });
                 }
            });
        }
};

jQuery(document).ready(function() {
	CheckoutTracking.trackClicks();
});
</script>