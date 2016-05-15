<h1>Update Payment</h1>

<h3 class="text-center">	Update payment details for order #: <?php echo $order->number; ?></h3>

<div class="alert alert-danger text-center" role="alert">
	<strong>Oh no! It looks like there were some issues with your payment.</strong><br />
	Please double check your card information including billing address,
	sufficient funds and daily card allowance. <br />
	<br /> If you have spoken with your card issuer and have the details
	worked out...<br /> click the "I've already resolved the issue.."
	button, otherwise update the payment information and click the "update"
	button
</div>

<hr>
<div class="text-center">
	<form name="formcheck" method="post"
		action="/shop/order/updatepayment/<?php echo $order->id;?>"
		class="form-horizontal">
				
		<input type="hidden" name="action" value="retry">
		<button type="submit" class="btn btn-primary btn-lg text-center" value="retryy">I've already resolved the issue...</button>
		 
	</form>
</div>

<div class="text-center">
	<h3>- or -</h3>
	<br />
</div>

<form id="checkout" name="checkout" method="post" action="/shop/order/updatepayment/<?php echo $order->id;?>" class="form-horizontal">
	<input type="hidden" name="action" value="update">
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<legend> Update Payment Information </legend>
			<div id="dropin"></div>
		</div>
		<div class="col-lg-6 col-md-6">
			<fieldset>
				<legend> Billing Information </legend>
				<div class="form-group">
					<label for="billing[name]" class="col-sm-2 control-label"> Name: </label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="billing[name]"
							value="<?php echo $order->{'billing_address.name'}; ?>"
							maxlength="30" class="checkout_form">
					</div>
				</div>
				<div class="form-group">
					<label for="billing[line_1]" class="col-sm-2 control-label">
						Address: </label>
					<div class="col-sm-10">
						<input type="address" class="form-control"
							name="billing[line_1]"
							value="<?php echo $order->{'billing_address.line_1'}; ?>"
							maxlength="30">
					</div>
				</div>
				<div class="form-group">
					<label for="billing[line_2]" class="col-sm-2 control-label"> </label>
					<div class="col-sm-10">
						<input type="address" class="form-control"
							name="billing[line_2]"
							value="<?php echo $order->{'billing_address.line_2'}; ?>"
							maxlength="30" class="checkout_form">
					</div>
				</div>
				<div class="form-group">
					<label for="billing[city]" class="col-sm-2 control-label"> City: </label>
					<div class="col-sm-10">
						<input type="city" class="form-control" name="billing[city]"
							value="<?php echo $order->{'billing_address.city'}; ?>"
							maxlength="25" class="checkout_form">
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-2 control-label" for="billing[country]">Country:</label>
					<div class="col-sm-10">
						<select class="form-control country" required="required"
							name="billing[country]" id="billing-country"
							autocomplete="country" required>
					                    <?php foreach (\Shop\Models\Countries::defaultList() as $country) { ?>
					                        <option
								data-requires_postal_code="<?php echo $country->requires_postal_code; ?>"
								value="<?php echo $country->isocode_2; ?>"
								<?php if ($order->{'billing_address.country'} == $country->isocode_2) { echo "selected"; } ?>><?php echo $country->name; ?></option>
					                    <?php } ?>
					                    </select>
					</div>
				</div>

				<div class="form-group">
					<label for="billing[region]" class="col-sm-2 control-label"> State: </label>

					<div class="col-sm-10">
						<select class="form-control region" required="required"
							name="billing[region]" id="shipping-region"
							autocomplete="region" required>
							<option value=""><strong>--</strong>
							</option>
					                    <?php foreach (\Shop\Models\Regions::byCountry( $order->{'billing_address.country'} ) as $region) { ?>
					                        <option
								value="<?php echo $region->code; ?>"
								<?php if ($order->{'billing_address.region'} == $region->code) { echo "selected"; } ?>><?php echo $region->name; ?></option>
					                    <?php } ?>
		                    </select>
					</div>
					
				</div>

				<div class="form-group">
					
					<label for="billing[postal_code]" class="col-sm-2 control-label"> Zip: </label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="billing[postal_code]"
							value="<?php echo $order->{'billing_address.zipcode'}; ?>"
							maxlength="10" class="checkout_form">
					</div>
				</div>

				<div class="form-group">
					<label for="billing[phone_number]" class="col-sm-2 control-label">Phone:</label>
					<div class="col-sm-10">
						<input type="tel" required class="form-control"
							name="billing[phone_number]" value="" maxlength="20" class="checkout_form">
					</div>
				</div>
		
		</div>

		<div class="col-xs-12 text-right">
			<input type="submit" class="btn btn-success btn-lg text-center"
				alt="Update" value="Update">
		</div>
</div>
</form>

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script src="https://js.braintreegateway.com/v1/braintree-data.js"></script>
<?php
$user = $this->auth->getIdentity ();
if (! empty ( $user->{'braintree.id'} )) :
	try {
		$clientToken = Braintree_ClientToken::generate ( array (
				"customerId" => $user->{'braintree.id'} 
		) );
		$clientToken = Braintree_ClientToken::generate ();
	} catch ( \Exception $e ) {
		$clientToken = Braintree_ClientToken::generate ();
	}
 else :
	$clientToken = Braintree_ClientToken::generate ();
endif;

?>

<script>
  braintree.setup(
  "<?php echo $clientToken; ?>",
  'dropin', {
    container: 'dropin'
  });

  var client = new braintree.api.Client({clientToken: "<?php echo $clientToken; ?>"});
  var env = BraintreeData.environments.production.withId("600390");
    BraintreeData.setup("6tmb54r5njbgjkf7", 'checkout', env);
</script>



<br />
<legend> Order Details: </legend>

<div class="panel panel-default">
	<div class="panel-body">

		<div class="form-group">
			<legend>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<small>Summary</small>
					</div>
				</div>
			</legend>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div>
						<label>Order #</label> <span class="order-number">
                                <?php echo $order->{'number'}; ?>
                            </span>
					</div>
					<div>
						<label>Date:</label> <span>
                                <?php echo (new \DateTime($order->{'metadata.created.local'}))->format('F j, Y g:ia'); ?>
                            </span>
					</div>
					<div>
						<label class="strong">Total:</label> <span class="price"><?php echo \Shop\Models\Currency::format( $order->grand_total ); ?></span>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div>
						<label>Status:</label>
                            
                            <?php
																												
switch ($order->{'status'}) {
																													case \Shop\Constants\OrderStatus::cancelled :
																														$label_class = 'label-danger';
																														break;
																													case \Shop\Constants\OrderStatus::closed :
																														$label_class = 'label-default';
																														break;
																													case \Shop\Constants\OrderStatus::open :
																													default :
																														$label_class = 'label-success';
																														break;
																												}
																												?>
                            
                            <span
							class="label <?php echo $label_class; ?>">
                            <?php echo $order->{'status'}; ?>
                            </span>

					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<div class="form-group">
			<legend>
				<small>Shipping Information</small>
			</legend>
                <?php if (!$order->{'shipping_required'}) { ?>
                    <p>Shipping not required.</p>
                <?php } else { ?>
                <div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6">
                    <?php if ($order->{'shipping_address'}) { ?>
                        <address>
                            <?php echo $order->{'shipping_address.name'}; ?><br />
                            <?php echo $order->{'shipping_address.line_1'}; ?><br />
                            <?php echo !empty($order->{'shipping_address.line_2'}) ? $order->{'shipping_address.line_2'} . '<br/>' : null; ?>
                            <?php echo $order->{'shipping_address.city'}; ?> <?php echo $order->{'shipping_address.region'}; ?> <?php echo $order->{'shipping_address.postal_code'}; ?><br />
                            <?php echo $order->{'shipping_address.country'}; ?><br />
					</address>
                        <?php if (!empty($order->{'shipping_address.phone_number'})) { ?>
                        <div>
						<label>Phone:</label> <?php echo $order->{'shipping_address.phone_number'}; ?>
                        </div>
                        <?php } ?>
                
                    <?php } ?>
                    </div>
				<div class="col-xs-12 col-sm-12 col-md-6">
                    <?php if ($method = $order->shippingMethod()) { ?>
                    <div>
						<label>Method:</label> <?php echo $method->{'name'}; ?> &mdash; <?php echo \Shop\Models\Currency::format( $method->total() ); ?>
                    </div>
                    <?php } ?>
                    </div>
			</div>
        <?php } ?>
        
    </div>

	</div>
</div>



<div class="panel panel-default">
	<div class="panel-body">
		<div class="form-group">
			<legend>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<small>Items</small>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-6">
						<small>Price</small>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-6">
                            <?php 
/*
																       * ?>
																       * <small>Status</small>
																       */
																												?>
                        </div>
				</div>
			</legend>        
        
                <?php foreach ($order->items as $item) { ?>
                <div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="row">
                        
                            <?php if (\Dsc\ArrayHelper::get($item, 'image')) { ?>
                            <div
							class="hidden-xs hidden-sm col-md-2 col-lg-2">
							<img class="img-responsive"
								src="<?php echo  \RallyShop\Models\Products::product_thumb(\Dsc\ArrayHelper::get($item, 'image'));?>"
								alt="" />
						</div>
                            <?php } ?>
                            <div
							class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
							<h4>
                                    <?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?>
                                    <?php if (\Dsc\ArrayHelper::get($item, 'attribute_title')) { ?>
                                    <div>
									<small><?php echo \Dsc\ArrayHelper::get($item, 'attribute_title'); ?></small>
								</div>
                                    <?php } ?>                        
                                </h4>
							<div class="details"></div>
							<div>
								<span class="quantity"><?php echo $quantity = \Dsc\ArrayHelper::get($item, 'quantity'); ?></span>
								x <span class="price"><?php echo \Shop\Models\Currency::format( $price = \Dsc\ArrayHelper::get($item, 'price') ); ?></span>
							</div>
						</div>

					</div>
				</div>

				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <?php echo \Shop\Models\Currency::format( $quantity * $price ); ?>
                    </div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>

			</div>        
       		 <?php } ?>
       		 </div>
	</div>
</div>





