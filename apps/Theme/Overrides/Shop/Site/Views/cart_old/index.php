<?php echo $this->renderView('Shop/Site/Views::cart/cart_tracking.php'); ?>
<div class="">
    <div id="cartView">
    <div id="loaderFull" style="display: none;"></div>
        <?php if (empty($cart->items)) : ?>
            <h2>Your cart is empty!</h2>
        <?php else : ?>
            <div class="row">
							        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 cartProducts">
							        <h1 class="underline">Your items</h1>
							                    <?php foreach ($cart->items as $key => $item) {  ?>
							           				 <!-- start -->
							                          <div class="cart-product row">
							                                <div class="col-xs-8">
								                                	<?php if (\Dsc\ArrayHelper::get($item, 'image')) { ?>
									                                    <a href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>">
									                                        <img src="<?php echo  \RallyShop\Models\Products::product_thumb(\Dsc\ArrayHelper::get($item, 'image'));?>" alt="" class="col-xs-4 hidden-xs" />
									                                    </a>
								                                    <?php } ?>

								                                    <h5 class="marginTopNone marginBottomNone">
								                                        <a href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>"><?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?><br/><small><?php echo \Dsc\ArrayHelper::get($item, 'model_number'); ?></small></a>
								                                        <?php if (\Dsc\ArrayHelper::get($item, 'attribute_title')) { ?>
								                                            <div><small><?php echo \Dsc\ArrayHelper::get($item, 'attribute_title'); ?></small></div>
								                                        <?php } ?>
								                                    </h5>

								                                    <div class="col-xs-8 details paddingLNone paddingRNone">
								                                        <?php if (\Dsc\ArrayHelper::get($item, 'model_number') == 'RSD 50101'): ?>
                                                                            Recipient: <?php echo \Dsc\ArrayHelper::get($item, 'email') ?>
                                                                        <?php else: ?>
                           
                                                                            <?php switch (\RallyShop\Models\Products::variantInstock($item['product_id'], $item['variant_id'])) :
                                                                                case 'instock': ?>
                                                                                    <strong class="instock">In Stock: Ships the Same Day</strong>
                                                                                    <?php break; ?>
                                                                                <?php case 'outofstock': ?>
                                                                                <?php case 'onorder': ?>
                                                                                    <strong>Out of Stock <?php if(\Dsc\ArrayHelper::get($item,'eta')) { echo ': ships '. \Dsc\ArrayHelper::get($item,'eta'); }?></strong>
                                                                                    <?php break; ?>
                                                                            <?php endswitch; ?>
                                                                        <?php endif; ?>

									                                        <?php if (\Dsc\ArrayHelper::get($item, 'sku')) { ?>
                                                                                <p class="detail-line">
                                                                                    <label>SKU:</label> <?php echo \Dsc\ArrayHelper::get($item, 'sku'); ?>
                                                                                </p>
									                                        <?php } ?>

									                                        <?php
                                                                                $active = $this->session->get('activeVehicle');

                                                                                if(empty($active)) {
                                                                                    echo $this->renderView ( 'Shop/Site/Views::cart/fitments/noymm.php' );
                                                                                }  else {
                                                                                    if(@$item['product']['universalpart']) {
                                                                                        echo $this->renderView ( 'Shop/Site/Views::cart/fitments/universal.php' );
                                                                                    } else {
                                                                                        $ymms = @$item['product']['ymms'];

                                                                                        if(is_array($ymms) && $active['slug']) {
                                                                                            $fit = false;

                                                                                                foreach($ymms as $vehicle) :
                                                                                                    if($active['slug'] == $vehicle['slug']) { ?>
                                                                                                        <div class="cart-fit">
                                                                                                            <small class="text-success">Fits your: <strong><?php echo $vehicle['title']; ?> </strong></small>
                                                                                                            <?php if (!empty($vehicle['notes'])) : ?>
                                                                                                                <small class="ymmsNotes"> ( <?php  echo   $vehicle['notes']; ?> )</small>
                                                                                                            <?php endif;?>
                                                                                                         </div>
                                                                                                        <?php $fit = true;
                                                                                                        break;
                                                                                                    }
                                                                                                endforeach;

                                                                                            if (!$fit) {
                                                                                                echo $this->renderView ( 'Shop/Site/Views::cart/fitments/nofit.php' );
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
									                                        ?>
								                                    </div>
							                                </div>

								                            <div class="price col-xs-4 paddingLNone paddingRNone">

								                           		<h5 class=""><?php echo \Shop\Models\Currency::format( $cart->calcItemSubtotal( $item ) ); ?></h5>

											                          <div class="">
											                            	 <select  data-hash="<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>"  class="fgBlack bgWhite cartUpdateQuantities " id="quantities-<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>" name="quantities[<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>]" <?php echo \Dsc\ArrayHelper::get($item, 'model_number') == 'RSD 50101' ? 'disabled' : '' ?>>
                                                                                <?php for ($i = 1; $i < 11; $i++) { ?>
                                                                                    <option class="fgBlack bgWhite" value="<?php echo $i; ?>" <?php if ($i == \Dsc\ArrayHelper::get($item, 'quantity')) { echo "selected=selected"; } ?>><?php echo $i; ?></option>
                                                                                <?php } ?>
											                            	 </select>
											                                 <a href="./shop/cart/remove/<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>" class="btn btn-xs btn-default cartRemove paddingTop"  data-analytics='<?php echo \Dsc\ArrayHelper::get($item, 'model_number'); ?>'><i class="glyphicon glyphicon-remove-2 "></i></a>	<br/>
<!--											                                 <a href="./shop/cart/movetowishlist/--><?php //echo \Dsc\ArrayHelper::get($item, 'hash'); ?><!--/--><?php //echo \Dsc\ArrayHelper::get($item, 'variant_id'); ?><!--" class="btn btn-xs btn-link fgBlue moveToWishlist" style="padding-left:0px">Move to wishlist</a>-->

                                                                          <form action="./shop/cart/movetowishlist/<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>/<?php echo \Dsc\ArrayHelper::get($item, 'variant_id'); ?>" method="POST">
                                                                                <?php if ($email = \Dsc\ArrayHelper::get($item, 'email')): ?>
                                                                                    <input type="hidden" name="email" value="<?php echo $email ?>">
                                                                                <?php endif; ?>

                                                                              <a class="btn btn-xs btn-link fgBlue moveToWishlist" style="padding-left:0px">Move to wishlist</a>
                                                                          </form>
											                          </div>
								                            </div>
								                      </div><hr>
							                    <?php } ?>


										        <?php if($cart->subtotal() < 200) : ?>
											        <div class="row visible-md visible-lg">
												 		<div class="col-xs-12">
												 			<h4>Qualify for free shipping on orders over $200 <small>(Continental United States Only)</small></h4>
												 		</div>

													</div>
										    	<?php endif; ?>

										<?php $audit = \Audit::instance();
								        	if(!$audit->isMobile()) : ?>
										<div >
										    <hr style="margin-top: 100px;">
										    <script charset="utf-8" type="text/javascript">
												  r3_placement('cart_page.rr1');
											</script>
											
										</div>
										<?php endif; ?>
							        </div>




							        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 cart-summary">

							         <label class="marginTop box-header">Cart Summary</label>

							            <div class="margin-top">
							                <div class="total-box">
							                        <table class="table">
							                            <tbody>
							                            <tr>
							                                <td><h5 class="price">Subtotal:</h5></td>
							                                <td><h5 class="price"><?php echo \Shop\Models\Currency::format( $cart->subtotal() ); ?></h5></td>
							                            </tr>
							                            <?php if ($user_coupons_nonshipping = $cart->userCoupons(false)) {
							                                \Dsc\System::instance()->get( 'session' )->set( 'site.removecoupon.redirect', '/shop/cart' ); ?>
							                                <?php foreach ($user_coupons_nonshipping as $coupon) { ?>
							                                    <tr class="coupon">
							                                        <td>
							                                            <div class="row">
							                                                <div class="col-xs-8"><div class="strong">Coupon:<br/><?php echo $coupon['code']; ?></div></div>
							                                                <div class="col-xs-4"><a href="./shop/cart/removeCoupon/<?php echo $coupon['code']; ?>" class="btn btn-xs btn-link"><i class="glyphicon glyphicon-remove-2"></i></a></div>
							                                            </div>
							                                        </td>
							                                        <td class="col-xs-6">
							                                            <h5 class="price">-<?php echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($coupon, 'amount') ); ?></h5>
							                                        </td>
							                                    </tr>
							                                <?php } ?>
							                            <?php } ?>

							                            <?php if ($autocoupons_nonshipping_discount = $cart->autoDiscountTotal(true)) { ?>
							                                <tr class="auto_discount">
							                                    <td>
							                                        <h5 class="price">Discount:</h5>
							                                    </td>
							                                    <td class="col-xs-6">
							                                        <h5 class="price">-<?php echo \Shop\Models\Currency::format( $autocoupons_nonshipping_discount ); ?></h5>
							                                    </td>
							                                </tr>
							                            <?php } ?>

							                            <tr>
							                                <td><div class="strong">
							                                        <h5 class="price">Shipping:</h5>
							                                    </div></td>
							                                <td><h5 class="price">
							                                    <?php
							                                        $shippingTotal = $cart->shippingTotal();
                                                                    echo \Shop\Models\Currency::format($shippingTotal);
                                                                ?>
							                                </h5></td>
							                            </tr>

							                            <?php if ($user_coupons_shipping = $cart->userCoupons(true)) {
							                                \Dsc\System::instance()->get( 'session' )->set( 'site.removecoupon.redirect', '/shop/cart' ); ?>
							                                <?php foreach ($user_coupons_shipping as $coupon) { ?>
							                                    <tr class="coupon">
							                                        <td>
							                                            <div class="row">
							                                                <div class="col-xs-12"><h5 class="strong">Shipping Coupon:<br/><?php echo $coupon['code']; ?></h5></div>
							                                            </div>
							                                        </td>
							                                        <td class="col-xs-6">
							                                            <h5 class="price">-<?php echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($coupon, 'amount') ); ?></h5>
							                                        </td>
							                                    </tr>
							                                <?php } ?>
							                            <?php } ?>

							                            <?php if ($autocoupons_shipping_discount = $cart->autoShippingDiscountTotal()) { ?>
							                                <tr class="auto_discount">
							                                    <td>
							                                       <h5 class="price">Shipping Discount:</h5>
							                                    </td>
							                                    <td class="col-xs-6">
							                                        <h5 class="price">-<?php echo \Shop\Models\Currency::format( $autocoupons_shipping_discount ); ?></h5>
							                                    </td>
							                                </tr>
							                            <?php } ?>

							                            <?php if ($credit = $cart->creditTotal()) { ?>
							                                <tr class="auto_discount">
							                                    <td>
							                                        <div class="strong">Store Credit:</div>
							                                    </td>
							                                    <td class="col-xs-6">
							                                        <h5 class="price">-<?php echo \Shop\Models\Currency::format( $credit ); ?></h5>
							                                    </td>
							                                </tr>
							                            <?php } ?>

							                            <tr>
							                                <td>
							                                	<h5 class="price">Tax:</h5>
							                                </td>
							                                <td><h5 class="price">
                                                                <?php echo \Shop\Models\Currency::format( $cart->taxTotal(true) ); ?>
							                                </h5></td>
							                            </tr>
							                            <?php if ($giftcards = $cart->giftcards) { \Dsc\System::instance()->get( 'session' )->set( 'site.removegiftcard.redirect', '/shop/cart' ); ?>
							                                <?php foreach ($giftcards as $giftcard) { ?>
							                                    <tr class="giftcard">
							                                        <td>
							                                            <div class="row">
							                                                <div class="col-xs-8 strong">Gift Card</div>
							                                                <div class="col-xs-4"><a href="./shop/cart/removeGiftCard/<?php echo $giftcard['code']; ?>" class="btn btn-xs btn-link"><i class="glyphicon glyphicon-remove"></i></a></div>
							                                            </div>
							                                            <small><?php echo $giftcard['code']; ?></small>
							                                        </td>
							                                        <td class="col-xs-6">
							                                            <div class="price">-<?php echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($giftcard, 'amount') ); ?></div>
							                                        </td>
							                                    </tr>
							                                <?php } ?>
							                            <?php } ?>

							                            </tbody>

							                            <tfoot>
							                                <td>
								                                <div class="strong">
                                                                    <h4><strong>Total:</h4>
								                                </div>
							                                </td>
							                                <td><div class="price  fgOrange"><h4><strong><?php echo \Shop\Models\Currency::format( $cart->total() ); ?></strong></h4></div></td>
							                            </tfoot>
							                        </table>
							                         <?php if (empty($cart->userCoupons())) : \Dsc\System::instance()->get( 'session' )->set( 'site.addcoupon.redirect', '/shop/cart' ); ?>
                            <div class="form-group">
                                <div id="coupon">
                                    <form role="form" action="./shop/cart/addCoupon" method="post" class="form-inline">
                                    
                                    <div class="input-group">

 <input type="text" name="coupon_code" class="form-control" id="inputCouponCode" placeholder="enter coupon code" no-validation="true">
 <span class="input-group-btn">
       <button class="btn btn-default" type="submit">Apply</button>
      </span>


</div>
                                    
               
                                                    
                    
                    
                                   
                                    </form>
                                </div>
                            </div>
        <?php endif; ?>
							                </div>
							            </div>




							            <div class="margin-top text-right cart-payment-box">
							            
							           
        
							            
								                <div class="form-group">
								                	<?php if ($cart->shippingRequired()): ?>
								                	 <a href="#" class="btn btn-default btn-sm btn-block estimateShow">Estimate Shipping</a>

								                	 	<div class="formgroup estimateShippingForm" style="display:none;">
								                	 	<hr>
								                	 	<fieldset>
								                	 		<form method="post" id="estimateShippingForm" action="/shop/cart/estimateshipping">
								                	 		<select class="form-control country" required="required" name="checkout[shipping_address][country]" id="estimateShippingCountry" autocomplete="country"  required no-validation="true">
											                   	 <option value=""> <strong>Select Country</strong> </option>
											                    <?php foreach (\Shop\Models\Countries::defaultList() as $country) { ?>
											                        <option data-requires_postal_code="<?php echo $country->requires_postal_code; ?>" value="<?php echo $country->isocode_2; ?>" <?php if ($cart->shippingCountry() == $country->isocode_2) { echo "selected"; } ?>><?php echo $country->name; ?></option>
											                    <?php } ?>
										                    </select><br/>
										                    <div class="regionWrapper" >
								                	 		<select class="form-control region" required="required" name="checkout[shipping_address][region]" id="estimateShippingRegion" autocomplete="region" required no-validation="true">
											                    <option value=""> <strong>Select Region</strong> </option>
											                    <?php foreach (\Shop\Models\Regions::byCountry( $cart->shippingCountry() ) as $region) { ?>
											                        <option value="<?php echo $region->code; ?>" <?php if ($cart->{'checkout.shipping_address.region'} == $region->code) { echo "selected"; } ?>><?php echo $region->name; ?></option>
											                    <?php } ?>
			                  							   </select><br/>
			                  							   </div>
			                  							    <input type="hidden" class="form-control"   autocomplete="off" name="checkout[shipping_address][city]" value="" placeholder="City"><br/>
								                	 		<input type="text" class="form-control" id="estimateShippingZip"  autocomplete="off" name="checkout[shipping_address][postal_code]" value="<?php echo $cart->{'checkout.shipping_address.postal_code'}; ?>" placeholder="Zip Code" no-validation="true"><br/>

								                	 		<input type="hidden" class="form-control" id=""  autocomplete="off" name="checkout[shipping_address][line_1]" value="" placeholder="zip" no-validation="true">
								                	 		<input type="hidden" class="form-control" id=""  autocomplete="off" name="checkout[shipping_address][line_2]" value="" placeholder="zip" no-validation="true">

								                	 		<input type="hidden" class="form-control" id=""  autocomplete="off" name="checkout[shipping_address][name]" value="" placeholder="zip" no-validation="true">



								                	 		<button type="submit" class="btn btn-default btn-sm btn-block">Estimate Shipping</button>
								                	 	</fieldset></form>
								                	 	<br/>
								                	 	</div>
								                	 <br/>
								                	 <?php endif; ?>

								                     <a href="./shop/checkout" class="btn btn-warning btn-lg btn-block paddingTopSm">Proceed with order <i class="fa fa-angle-right"></i></a>

<?php if(!empty($cart->nonce)) : ?>
		<a class="btn btn-link btn-block  fgBlue" href="/shop/checkout/removepaypal"><small>Cancel Paypal Express Checkout</small></a>
		<?php else : ?>
									<fieldset class="paymentDivider">
   		 <legend>Or Use <br> Express Checkout</legend>
		</fieldset>
		<script type="text/javascript" src="https://js.braintreegateway.com/v2/braintree.js"></script>
<div id="paypal-container"></div>
    <script type="text/javascript">
    braintree.setup("<?php echo \Braintree_ClientToken::generate();?>", "paypal", {
  	  container: "paypal-container",
      singleUse: false,
  	  currency: 'USD',
      enableShippingAddress: true,
    	onPaymentMethodReceived: function (obj) {
            $.ajax({
                type: 'POST',
                url: '/shop/cart/express',
                data: obj,
                cache: false,


                success: function(data) {
                    $('#loaderFull').show();

                	window.location.href = "/shop/checkout";
                }
            });
        }

	});
    </script>
<?php endif; ?>

								                </div>
							            </div>
							        </div>
		</div>
	<?php endif; ?>


							</div>

<?php $audit = \Audit::instance();
								        	if($audit->isMobile()) : ?>
										<div >
										    <hr style="margin-top: 100px;">
										    <script charset="utf-8" type="text/javascript">
												  r3_placement('cart_page.rr1');
											</script>
											
										</div>
										<?php endif; ?>



</div>
<script charset="utf-8" type="text/javascript">
											  rr_flush_onload();
											</script>