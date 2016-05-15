<script charset="utf-8" type="text/javascript">
  <?php echo $this->renderView('Theme/Views::common/richrevelance.php'); ?>
  // here's an example requesting recommendations for 3 page areas
  R3_COMMON.addPlacementType('personal_page.rr1');
  R3_COMMON.addPlacementType('personal_page.rr2');
  R3_COMMON.addPlacementType('personal_page.rr3');
 
  var R3_PERSONAL = new r3_personal();
 
  r3();
 
</script>

<div class="row">
	<div class="row-same-height">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-sm-height col-top">
			<div class="row">
				<div class="col-lg-3 col-md-5 col-xs-12"><h2>MY ACCOUNT</h2></div>
				<h4>
				<!--  
				<div class="col-lg-9  col-sm-12 col-xs-12 paddingTop">
					<ul class="list-inline text-left horizontalListSep  paddingLNone paddingRNone pull-right">
						<li><a href="/shop/account/#orders"><small>Orders</small></a></li>
						<li><a href="/shop/account/#returns"><small>Returns</small></a></li>
						<li><a href="/shop/account/#info"><small>Info</small></a></li>
						<li><a href="/shop/account/#email"><small>Email Preferences</small></a></li>
						<li class="hidden-md hidden-lg"><a href="/shop/account/#profile"><small>My Profile</small></a></li>
					</ul>
				</div>
				-->
			</h4>
</div>

 <?php $xEditable = new \Dsc\Html\xEditable($user, '/shop/account/edit'); ?>
          <?php $publishStates = array(array('value' => 'draft', 'text' => 'draft'), array('value' => 'unpublished', 'text' => 'unpublished'), array('value' => 'published', 'text' => 'published')) ; ?>
      

					
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
					<a name="orders"></a>
					<legend>ORDERS <?php  if ( !empty( $orders) && count($orders) >= 3  ) { echo "<small><small class='pull-right showingOrders'>( showing 3 of ".count($orders). " )</small></small>"; } ?></legend>
					
				</div>
			</div>	
			<div class="row">
			<div id="myOrders" class="" role="tabpanel" aria-labelledby="headingSeven">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
				
					
					
						<?php  if ( !empty( $orders) ):?>
					
					<?php $shown = 0; foreach ($orders as $orderNumber => $order) : ?>



					<div class="panel panel-default" <?php  if ($shown >= 3 ): echo 'style="display:none;"'; endif; $shown++;  ?>>
						
						<div class="panel-heading" role="tab" id="headingOrders<?php echo $orderNumber; ?>">
							<div class="panel-title">
								<div class="row">
									<div class="col-xs-6"> 
										<strong><a data-toggle="collapse" class="" data-parent="#accordion"
											href="#collapseOrders<?php echo $orderNumber; ?>" aria-expanded="true"
											aria-controls="collapseOrders1"> <?php echo $order['date']->format('m/d/y'); ?></a></strong>
									</div>
									<div class="col-xs-6">
										<a data-toggle="collapse" class="" data-parent="#accordion"
											href="#collapseOrders<?php echo $orderNumber; ?>" aria-expanded="true"
											aria-controls="collapseOrders1"><small>#<?php echo $orderNumber; ?></small></a>
									</div>
									<div class="col-xs-6">
                                        <?php if ($order['needs_payment']): ?>
                                            <strong><a data-toggle="collapse" class="fgOrange" data-parent="#accordion"
                                                href="#collapseOrders<?php echo $orderNumber; ?>" aria-expanded="true"
                                                aria-controls="collapseOrders1"> REQUIRES PAYMENT UPDATE</a></strong>
                                        <?php endif; ?>
									</div>
									<div class="col-xs-6">
										<strong><a data-toggle="collapse" class="fgOrange" data-parent="#accordion"
											href="#collapseOrders<?php echo $orderNumber; ?>" aria-expanded="true"
											aria-controls="collapseOrders1"><?php echo \Shop\Models\Currency::format( $order['totals']['total'] ); ?></a></strong>
									</div>
								</div>
							</div>
						</div>
						
						<div id="collapseOrders<?php echo $orderNumber; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOrders1">
							<div class="panel-body " >
							
		
							
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
	

								<?php foreach ($order['invoices'] as $invoiceNumber => $invoice) : ?>
								<?php
									  	$provider = $invoice['shipping']['provider'];
									  	
									  	if(!empty($provider)) {
									  		switch ($provider) {
									  			case 'UPS':
									  				$url = 'http://wwwapps.ups.com/WebTracking/track?track=yes&trackNums=';
									  				break;
									  			case 'FedEx':
									  				$url = 'http://www.fedex.com/Tracking?action=track&tracknumbers=';
									  				break;
									  			case 'USPS':
									  				$url = 'http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?origTrackNum=';
									  				break;
									  			default:
									  				$url = null;
									  		}
									  	}
									  	
									  	?>
								
								
								
								
									<br/>
								   <div class="panel panel-default">
									 <div class="panel-heading">
									 <div class="pull-right">
									 		<?php if (!empty( $invoice['shipping']['tracking_numbers']) ):?>
											<strong>Tracking Number(s):</strong><br/>
									 		<?php endif;?>
											<?php foreach ( $invoice['shipping']['tracking_numbers']  as $value) :?>
												<?php if(!empty($url)) :?>
													<a target="_blank" href="<?php echo $url.$value ?>"><span class="badge">
													<?php endif;?>
													<?php echo $value; ?>
													<?php if(!empty($url)) :?>
													</span></a>&nbsp;
												<?php endif;?>
											<?php endforeach; ?><br/>	<br/>								 
									 </div>
									 <?php echo $invoiceNumber; ?><br/><span class="fgOrange"><?php echo $invoice['status']; ?></span>
		
									 </div>
									  <div class="panel-body">

									  	
									  	
									 

					
	
								
								<?php if($invoice['status'] =="REQUIRES PAYMENT UPDATE") :?><br><br>
									<div class="alert alert-danger" role="alert">This order requires a payment update. <a href="/shop/order/updatepayment/<?php echo $orderNumber; ?>">Click here to update payment information.</a></div>
								<?php  endif;?>
								
								<?php foreach($invoice['items'] as $item) : ?>
								
				
									<div class="row paddingTopLg">
										<div class="col-lg-3 hidden-xs">
										<img src="<?php echo  \RallyShop\Models\Products::product_thumb(\Dsc\ArrayHelper::get($item, 'product.featured_image.slug'));?>" alt="160x66" class="img-responsive" />
				
										</div>
										<div class="col-lg-6 col-xs-8">
											<h4><strong><?php echo \Dsc\ArrayHelper::get($item, 'product.title');?></strong></h4>
                                            <div>Part Number: <a href="/shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug');?>"><?php echo \Dsc\ArrayHelper::get($item, 'model_number');?></a></div>
                                            <?php
                                                if (
                                                    in_array(\Dsc\ArrayHelper::get($item, 'model_number'), ['RSD 50100', 'RSD 50101'])
                                                    && !empty(\Dsc\ArrayHelper::get($item, 'email'))
                                                ) :
                                            ?>
                                                <div>Recipient: <?php echo \Dsc\ArrayHelper::get($item, 'email'); ?></div>
                                            <?php endif; ?>
											<div><?php echo \Dsc\ArrayHelper::get($item, 'quantity');?> x <?php  echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($item, 'price'));?><br/>
											<a href="/shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug');?>/create/review">Review this item</a>
											</div>
										</div>
										<div class="col-lg-3 col-xs-4">
											<h4><?php  echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($item, 'price'));?></h4>
											
										</div>
									</div>	
				
								<?php endforeach;?>	

								
									<?php if($invoice['can_return']) :?>							
									<p class="paddingTop">
										<a href="/shop/return/order/<?php echo $invoice['id']; ?>" class="btn btn-default btn-md btn-block" type="submit">RETURN ITEMS</a>
									</p>
									<?php endif; ?>
									
									
									
					
																		
								
									</div></div>
						
											
								<?php endforeach; ?>	
								

								</div>			
								
								<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 paddingTop">
									<?php if(!empty($order->payment_methods)) : ?>
									<table
										class="col-lg-5 col-md-5 col-sm-12 col-xs-12 table-condensed ">
										<thead>
										
											<tr>
												<td>PAYMENT:</td>
											</tr>
											<?php foreach ($order->payment_methods as $method) : if (array_key_exists('type', $method)) { ?>
												<?php if($method['type'] == 'paypal') : ?>
													<tr>
														<td>PAYPAL: (<?php echo $method['email']?>)</td>
														<td></td>
													</tr>
												<?php endif;?>	
												<?php if($method['type'] == 'card') : ?>
													<tr>
														<td><?php echo $method['cardType'];?> <?php echo $method['maskedNumber'];?></td>
														<td></td>
													</tr>
												<?php endif;?>
											<?php } endforeach;?>
											<?php if($order->giftcard_total > 0.00 ) : ?>
											<tr>
												<td>GiftCard</td>
												<td><?php echo \Shop\Models\Currency::format( $order->giftcard_total ); ?></td>
											</tr>
											<?php endif;?>
											
										</tbody>
									</table>
									<?php endif;?>
									
									<div>

									<legend><label>Shipping Destination:</label></legend>
									
									<address>
									  	<?php if(!empty($order['shipping_address']['name'])) : ?><strong><?php echo $order['shipping_address']['name']; ?></strong><br><?php endif; ?>
									  	<?php if(!empty($order['shipping_address']['line_1'])) : ?>
											<?php echo $order['shipping_address']['line_1']; ?><br>
										<?php endif;?>
										<?php if(!empty($order['shipping_address']['line_2'])) : ?>
											<?php echo $order['shipping_address']['line_2']; ?><br>
										<?php endif;?>
										<?php if(!empty($order['shipping_address']['city'])) : ?>
											<?php echo $order['shipping_address']['city']; ?>,
										<?php endif;?>
											<?php if(!empty($order['shipping_address']['region'])) : ?><?php echo $order['shipping_address']['region']; ?><?php endif; ?> <?php if(!empty($order['shipping_address']['postal_code'])) : ?><?php echo $order['shipping_address']['postal_code']; ?><?php endif; ?> 
										
										<br><?php if(!empty($order['shipping_address']['country'])) : ?><?php echo $order['shipping_address']['country']; ?><?php endif; ?>
									  	<br/><br/>

									  	
									</address>
		
	
												
										
		
									</div>
									
									
									
								</div>
								<div class="col-lg-offset-3 col-md-offset-3 col-lg-4 col-md-4 col-sm-12 col-xs-12 paddingTop">
									<table class="table table-condensed">
										<thead>
											<tr>
												<td><h5 class="price">Subtotal:</h5></td>
												<td><h5 class="price"><?php echo \Shop\Models\Currency::format( $order['totals']['subtotal'] ); ?></h5></td>
											</tr>
											<tr>
												<td><h5 class="price">Shipping:</h5></td>
												<td><h5 class="price"><?php echo \Shop\Models\Currency::format( $order['totals']['shipping'] ); ?></h5></td>
											</tr>
											<?php if ( $order['totals']['shipping_discount'] > 0) : ?>
											<tr>
												<td><h5 class="price">Shipping Discount:</h5></td>
												<td><h5 class="price"><?php echo \Shop\Models\Currency::format( $order['totals']['shipping_discount'] ); ?></h5></td>
											</tr>
											<?php endif; ?>
											<tr>
												<td><h5 class="price">Tax:</h5></td>
												<td><h5 class="price"><?php echo \Shop\Models\Currency::format( $order['totals']['tax'] ); ?></h5></td>
											</tr>
											<?php if ( $order['totals']['discount'] > 0) : ?>
											<tr>
												<td><h5 class="price">Discount:</h5></td>
												<td><h5 class="price"><?php echo \Shop\Models\Currency::format( $order['totals']['discount'] ); ?></h5></td>
											</tr>
											<?php endif; ?>
										</thead>
										<tfoot>
											<tr>
												<th><h4 class="price">Total</h4></th>
												<th><h4 class="price fgOrange"><strong><?php echo \Shop\Models\Currency::format( $order['totals']['total'] ); ?></strong></h4></th>
											</tr>
										</tfoot>
									</table>
									
									
									
								</div>
							</div>					
						</div>						
					</div>
				

					
	<?php endforeach; ?>
					<?php else: ?>
						Your account has no orders to display.
					<?php endif;?>
				</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingTop paddingBottom">
					<?php  if ( !empty( $orders) && count($orders) > 3):?>
					<a href="#" class="btn btn-sm btn-block btn-primary" id="showAllOrders"><i
						class="glyphicon glyphicon-zoom-in"></i> VIEW ALL ORDERS</a>
					<?php endif;?>

				</div>			
			</div>

					
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingTop">
				<a name="returns"></a>
				
		
					<legend>RETURNS </legend>
								
				</div>
			</div>
			
			<div class="row">
			<div id="myOrders" class="" role="tabpanel" aria-labelledby="headingSeven">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
					<?php $returns = (new \RallyShop\Models\Returns)->setCondition('user_id', new MongoId((string) $this->auth->getIdentity()->id))->getItems();?>
					<?php foreach ($returns as $key => $order) :?>
					<?php 
						$orderStatus = $order->status;
						if ($orderStatus == \Shop\Constants\OrderStatus::cancelled) {
							$orderStatus = 'Cancelled';
						} else {
							$orderStatus = '';

							switch ($order->process_status) {
								case 'ORDER':
								case 'WEB ORDERS':
								case 'AVS/CCV REVIEW':
								case 'HOLDING':
								case 'WILL CALL':
								case 'DROP SHIP ORDER':
								case 'REVIEW':
								case 'PICKING':
									$orderStatus = 'Processing';
									break;
								case 'NEED TO PURCHASE':
								case 'WAITING FOR QTY':
								case 'CAN SPLIT ORDER':
									$orderStatus = 'Back Ordered';
									break;
								case 'COLLECTING':
								case 'IN SHIPPING':
								case 'AR-AUDIT':
									$orderStatus = 'Order Boxed / On Truck';
									break;
								case 'SHIPPED':
									$orderStatus = 'Shipped';
									break;
								case 'DECLINED':
									$orderStatus = 'Contact Customer Service';
									break;
								case 'NEEDS PAYMENT':
									$orderStatus = 'Requires Payment Update';
									break;
								default:
									$orderStatus = '';
							}
						}
					?>
					<div class="panel panel-default" <?php  if ($key >= 3 ): echo 'style="display:none;"'; endif; ?>>
						
						<div class="panel-heading" role="tab" id="headingReturns<?php echo $key; ?>">
							<div class="panel-title">
								<div class="row">
									<div class="col-xs-6">
										<strong><a data-toggle="collapse" data-parent="#accordion"
											href="#collapseReturns<?php echo $key; ?>" aria-expanded="true"
											aria-controls="collapseOrders1"> <?php echo (new \DateTime($order->{'metadata.created.local'}))->format('m/d/y'); ?></a></strong>
									</div>
									<div class="col-xs-6">
										<a data-toggle="collapse" data-parent="#accordion"
											href="#collapseReturns<?php echo $key; ?>" aria-expanded="true"
											aria-controls="collapseOrders1"><small>#<?php echo $order->number?></small></a>
									</div>
									<div class="col-xs-6">
										<strong><a data-toggle="collapse" class="fgOrange" data-parent="#accordion"
											href="#collapseOrders<?php echo $key; ?>" aria-expanded="true"
											aria-controls="collapseOrders1"> <?php echo $orderStatus; ?></a></strong>
									</div>
									<div class="col-xs-6">
										<strong><a data-toggle="collapse" class="fgOrange" data-parent="#accordion"
											href="#collapseReturns<?php echo $key; ?>" aria-expanded="true"
											aria-controls="collapseOrders1"><?php echo \Shop\Models\Currency::format( $order->grand_total ); ?></a></strong>
									</div>
								</div>
							</div>
						</div>
						
						<div id="collapseReturns<?php echo $key; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOrders1">
							<div class="panel-body " >
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
								<?php foreach($order->items as $item) : ?>
									<div class="row paddingTopLg">
										<div class="col-lg-3 hidden-xs">
											<a href="">
											<img src="<?php echo  \RallyShop\Models\Products::product_thumb(\Dsc\ArrayHelper::get($item, 'product.featured_image.slug'));?>" alt="160x66" class="img-responsive" />
											</a>
										</div>
										<div class="col-lg-6 col-xs-8">
											<h4><strong><?php echo \Dsc\ArrayHelper::get($item, 'product.title');?></strong></h4>
											
											<div><?php echo \Dsc\ArrayHelper::get($item, 'quantity');?> x <?php  echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($item, 'price'));?></div>
										</div>
										<div class="col-lg-3 col-xs-4">
											<h4><?php  echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($item, 'price'));?></h4>
											
										</div>
									</div>					
								<?php endforeach; ?>								
								
								</div>						
								<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 paddingTop">
			
								</div>
								<div
									class="col-lg-offset-3 col-md-offset-3 col-lg-4 col-md-4 col-sm-12 col-xs-12 paddingTop">
									<table class="table table-condensed">
										<thead>
											<tr>
												<td><h5 class="price">Subtotal:</h5></td>
												<td><h5 class="price"><?php echo \Shop\Models\Currency::format( $order->sub_total ); ?></h5></td>
											</tr>
											<tr>
												<td><h5 class="price">Shipping:</h5></td>
												<td><h5 class="price"><?php echo \Shop\Models\Currency::format( $order->shipping_total ); ?></h5></td>
											</tr>
											<?php if ( $order->shipping_discount_total > 0.00) : ?>
											<tr>
												<td><h5 class="price">Shipping Discount:</h5></td>
												<td><h5 class="price"><?php echo \Shop\Models\Currency::format( $order->shipping_discount_total ); ?></h5></td>
											</tr>
											<?php endif; ?>
											
											<tr>
												<td><h5 class="price">Tax:</h5></td>
												<td><h5 class="price"><?php echo \Shop\Models\Currency::format( $order->tax_total ); ?></h5></td>
											</tr>
											<?php if ( $order->discount_total > 0.00) : ?>
											<tr>
												<td><h5 class="price">Discount:</h5></td>
												<td><h5 class="price"><?php echo \Shop\Models\Currency::format( $order->discount_total ); ?></h5></td>
											</tr>
											<?php endif; ?>
										</thead>
										<tfoot>
											<tr>
												<th><h4 class="price">Total</h4></th>
												<th><h4 class="price fgOrange"><strong><?php echo \Shop\Models\Currency::format( $order->grand_total ); ?></strong></h4></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>					
						</div>						
					</div>
					<?php endforeach; ?>	
					
				</div>
				</div>
                </div>
				<div
					class="col-lg-12 col-md-12 col-sm-12 col-xs-12  paddingTop paddingBottom">
				<?php  if ( !empty( $returns) && count($returns) > 3):?>
					<a href="#" class="btn btn-sm btn-primary"><i
						class="glyphicon glyphicon-zoom-in"></i> VIEW ALL</a>
										
				<?php else: ?>
					<?php if ( empty( $returns)) : ?>
					Your account has no returns to display.
					<?php endif; ?>
				<?php endif;?>
				</div>
				<div class="row">
				<div class="col-xs-12">
				<a name="info"></a>
					<legend class="paddingTop">INFO</legend>
					<?php if(!empty($user->gp['customer_number'])) : ?>
					 <div class="form-group">
    					<label class="col-sm-4 control-label">Customer Number</label>
    					<div class="col-sm-8">
     						<p class="form-control-static"><?php  echo $user->gp['customer_number']; ?></p>
    					</div>
    				 </div>		
    				 <?php else : ?>
    				 
    				 <?php endif; ?>				
					
					 <div class="form-group">
    					<label class="col-sm-4 control-label">Email</label>
    					<div class="col-sm-8">
     						<p class="form-control-static"><?php  echo $xEditable->field('email'); ?></p>
    					</div>
    				 </div>	

					 <div class="form-group">
    					<label class="col-sm-4 control-label">Address(s)</label>
    					<div class="col-sm-8">

							<?php 
			          		 if ($existing_addresses = \RallyShop\Models\CustomerAddresses::fetch()) : ?>
			
			               		<?php foreach ($existing_addresses as $address) { ?>
			                		<a href="/shop/account/addresses/delete/<?php echo $address->id; ?>" class="pull-right"><i class="text-danger glyphicon glyphicon-remove"></i></a><small>  <?php echo $address->asString(', '); ?></small> <br/>
			               		 <?php } ?>
			           		 <?php endif; ?>

    					</div>
    				 </div>

				</div>
</div>
<div class="row">
				<div class="col-xs-12">
				<a name="profile"></a>
					<legend class="paddingTop">Profile</legend>
					
					 <div class="form-group">
    					<label class="col-sm-4 control-label">Screen Name</label>
    					<div class="col-sm-8">
     						<p class="form-control-static"><?php  echo $xEditable->field('profile.screen_name'); ?></p>
    					</div>
    				 </div>						
				
				</div>
</div>
<div class="row">
				<div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
				<a name="email"></a>
					<legend class="paddingTop">ACCOUNT PREFERENCES</legend>
				</div>
</div>
<form action="/shop/account/savepreferences" method="post">
<div class="row paddingBottom">
				<div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
					<div class="checkbox">
						<label><input name="preferences[emails][promo]" <?php if($user->{'preferences.emails.promo'}): ?> checked="checked"  <?php endif; ?> value='1'   type="checkbox" />Do not send promo and sales emails</label>
					</div>
					<div class="checkbox">
						<label><input name="preferences[emails][cart]" <?php if($user->{'preferences.emails.cart'}): ?> checked="checked"  <?php endif; ?> value='1'   type="checkbox" />Do not send cart contents related or wishlist price drop emails</label>
					</div>	
				</div>
				<div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
					
					<div class="checkbox">
						<label><input name="preferences[profile][showgarage]" <?php if($user->{'preferences.profile.showgarage'}): ?> checked="checked"  <?php endif; ?> value='1'  type="checkbox" /> Share my garage on my public profile</label>
					</div>
			
				</div>
				
				<div class="col-xs-12">
				<button type="submit" class="btn btn-primary ">Save Preferences</button>
				</div>
						
</form>
</div>
			</div>


		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-sm-height col-top checkoutSidebar">

			<h2 class="paddingTopLg">



				<a href="#" data-toggle="modal" data-target="#textModal" data-close="false" class="textModal"><img class="img-responsive img-circle"
					src="<?php echo $user->profilePicture('/images/profile/default.png');?>" /></a>
					<div class="textModalBody">

						<form method="post" enctype="multipart/form-data" action="/user/change-avatar">
							<h3>Change Avatar <small>250x 250 recommended </small></h3><br/>

							<input name="avatar" type="file" class="form-control valid">
							<br>
							<button type="submit" class="btn btn-primary ">Submit</button> <a class=" btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</a>
						</form>
					</div>
			</h2>
			<h2>
			    <a name="profile"></a>
				<small><?php echo $user->fullName(); ?></small><br />
				<?php
	            if ($existing_addresses = \RallyShop\Models\CustomerAddresses::fetch()) : ?>
					<small><?php echo htmlspecialchars( $existing_addresses[0]->city ); ?>, <?php echo htmlspecialchars( $existing_addresses[0]->region ); ?></small>
	            <?php endif; ?>

			</h2>
			<p>
				<a href="/profiles/<?php echo $user->id; ?>" class="btn btn-info btn-md ">
					<small>MY PROFILE</small>
				</a>
				
			
			</p>

			<div class="lead paddingTop">
				MY GARAGE
				<hr>
			</div>

			<?php if(count($this->auth->getIdentity()->garage)) : ?>
				<ul class="list-unstyled">

					<?php foreach($this->auth->getIdentity()->garage as $key=>$car) : ?>
						<li class="list-group-item">
							<a href="/user/garage/remove/<?php echo $car['slug']; ?>" class="pull-right"><i class="text-danger glyphicon glyphicon-remove"></i></a><small><?php echo $car['title']; ?></small>
						</li>
					<?php endforeach;?>

				</ul>
			<?php else : ?>
				<h3><i>Your garage is empty</i></h3><p><a href="#ymm" class="btn btn-sm" data-toggle="modal" data-target="#ymmModal">Select a car</a></p>
			<?php endif; ?>


		</div>

	</div>


</div>



