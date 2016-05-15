<?php $step = $this->app->get('step'); ?>

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script src="https://js.braintreegateway.com/v1/braintree-data.js"></script>
<div class="row">
	<div class="col-xs-12">
<?php if(!empty($cart->nonce)) : ?>
<input type="hidden" id="nonce" name="payment_method_nonce" value="<?php echo $cart->nonce; ?>">
		<script>
var env = BraintreeData.environments.production.withId("600390");
BraintreeData.setup("6tmb54r5njbgjkf7", 'checkout-payment-form', env);
</script>
<fieldset>
			<legend style="margin-bottom: 10px;">
				<small><strong class="fgBlue">Step <?php echo ++$step; ?>: Pay with Paypal</strong>
			
			</legend>
		<div id="row">
			<div class="fgBlue paddingBottom col-sx-12">
			 <label><input type="radio" checked> <img height="20px" src="https://www.paypalobjects.com/webstatic/logo/logo_paypal_212x56.png"> (<em><strong><?php echo $cart->email; ?></strong></em>)</label>
			</div>
		</div>
</fieldset>
<?php else : ?>
<fieldset>
 <?php if (!$cart->paymentRequired()) : ?>
	      <div class="form-group has-error">
					<label class="control-label">No payment necessary.</label>
				</div>
	      
	      <?php else : ?>
	      
			<legend style="margin-bottom: 0px; border-bottom:none;">
				<small><strong class="fgBlue">Step <?php echo ++$step; ?>: Pay with Credit Card</strong>
			
			<div class="pull-right"><i
							class="fa fa-cc-amex f fgBlue"></i> <i
							class="fa fa-cc-mastercard  fgBlue"></i> <i
							class="fa fa-cc-discover  fgBlue"></i> <i
							class="fa fa-cc-visa fgBlue"></i></div>
			</legend>
			

			
	     


<?php
$user = $this->auth->getIdentity ();
if (! empty ( $user->{'braintree.id'} )) :
	try {
		if(!empty($user->get('braintree.use_saved_payments')) && $user->get('braintree.use_saved_payments') ) {
			$clientToken = Braintree_ClientToken::generate ( array (
					"customerId" => $user->{'braintree.id'},
					"merchantAccountId" => 'RallySportDirectLLC_instant_2'
			) );
		} else {
			$clientToken = Braintree_ClientToken::generate ( array (
					"merchantAccountId" => 'RallySportDirectLLC_instant_2'
			) );
		}
	} catch ( \Exception $e ) {
		$clientToken = Braintree_ClientToken::generate ( array (
					"merchantAccountId" => 'RallySportDirectLLC_instant_2'
			) );
	}
 else :
	$clientToken = Braintree_ClientToken::generate ( array (
					"merchantAccountId" => 'RallySportDirectLLC_instant_2'
			) );
endif;
?>

<script>
  braintree.setup(
  "<?php echo $clientToken; ?>",
  'dropin', {
    container: 'dropin',
    form: "checkout-payment-form",
    onPaymentMethodReceived: function (obj) {
		if(obj.nonce) {
        console.log(obj);
		$('#nonce').val(obj.nonce);
		$( "#loaderFull").show();
			
		var $btn = $("#submit-order").button('loading');
		$('#checkout-payment-form').submit();

		} else {
   	     ga('send', 'event', 'Checkout', 'click', 'checkout submitted - no payment');
     	 $('#checkoutErrors').html('Payment form invalid').collapse('show');
     	 $('#loaderFull').hide();
		}
      
      },
      onError: function (obj) {

       	     ga('send', 'event', 'Checkout', 'click', 'checkout submitted - no payment');
         	 $('#checkoutErrors').html('Payment form invalid').collapse('show');
         	 $('#loaderFull').hide();
              exit;  
      }
  });
  var client = new braintree.api.Client({clientToken: "<?php echo $clientToken; ?>"});
  var env = BraintreeData.environments.production.withId("600390");
    BraintreeData.setup("6tmb54r5njbgjkf7", 'checkout-payment-form', env);
</script>

			
				<div class="bgWhite">
					
					<div id="dropin" class="bgWhite"></div>

				</div>
				<input type="hidden" id="nonce" name="payment_method_nonce" value="">
			</fieldset>
<?php endif;?>  
<br />


<?php endif; ?>
    
    <?php \Dsc\System::instance()->get('session')->set('site.shop.checkout.redirect', '/shop/checkout/confirmation'); ?>
  
  
  	<div id="checkoutErrors" class="collapse alert alert-danger"></div>
  <?php if (!$cart->paymentRequired()) { ?>
	    <div class="text-center">

				<button id="submit-order" data-loading-text="Processing..."
					type="submit"
					class="btn btn-warning btn-block custom-button btn-lg">
					Complete Purchase
				</button>
				<br />
				<small>By clicking "Complete Purchase", you agree to abide by our <a
					href="/pages/terms" target="_new">Terms and Conditions.</a></small>
			</div>   
	      <?php } else { ?>
      <div class="text-center">

				<button id="submit-order"  data-loading-text="Processing..."
					type="submit"
					class="btn btn-warning btn-block custom-button btn-lg marginTop marginBottom ">
					Complete Purchase 
				</button>
				<br />
				<div class="marginTop"><small >By clicking "Complete Purchase", you agree to abide by our <a
					href="/pages/terms" target="_new">Terms and Conditions.</a></small></div>
			</div>
    <?php }?>  

	
	</div>
</div>
