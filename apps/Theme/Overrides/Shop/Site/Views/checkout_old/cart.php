
<div class="table-responsive checkout-cart margin-top paddingTop">
    <table class="table">

        <tbody>
        <?php foreach ($cart->items as $key=>$item) : ?>
            <tr>

                <td class="checkout-cart-product col-xs-12">


                        <?php if ( \Dsc\ArrayHelper::get($item, 'quantity') > 1 ) { ?>
                        <?php echo \Dsc\ArrayHelper::get($item, 'quantity'); ?></span> &#215;&nbsp;

                        <?php  } ?>
                        <?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?>


                        <?php if (\Dsc\ArrayHelper::get($item, 'attribute_title')) { ?>
                         <br/>
                            <small><?php echo \Dsc\ArrayHelper::get($item, 'attribute_title'); ?></small>

                        <?php } ?>

                        <?php if (\Dsc\ArrayHelper::get($item, 'email')) { ?>
                            <br/>
                            <small>Recipient: <?php echo \Dsc\ArrayHelper::get($item, 'email'); ?></small>

                        <?php } ?>


                    <?php if ( \Dsc\ArrayHelper::get($item, 'quantity') > 1  &&  \Dsc\ArrayHelper::get($item, 'discount', 0.00) == 0.00  ) { ?>
                         <div>
                        <span class="price"><small><?php echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($item, 'price') ); ?> each</small></span>
                         </div>
                        <?php  } ?>

                        <?php if (!empty($cart->coupons)) : ?>
                            <?php if ( \Dsc\ArrayHelper::get($item, 'discount', 0.00) > 0.00 ) { ?>
                                 <div>
                                    <span class="discount"><small><?php echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($item, 'discount') ); ?> discount from coupon will apply</small></span>
                                 </div>
                            <?php  } else { ?>
                                <div>
                                    <span class="discount"><small>Item is not eligible for discount</small></span>
                                </div>
                            <?php } ?>
                        <?php endif; ?>

                  <?php if($message = \RallyShop\Models\Products::shippingRestrictionMessage($item['product_id'])) : ?>
	                 <div>
	                 <small class="text-danger">
		                 <?php echo $message; ?>
	                 </small>
	                 </div>
       			 <?php endif ;?>
              	</td>
              	<td>
                    <div class="subtotal paddingTopSm pull-right"><?php echo \Shop\Models\Currency::format( $cart->calcItemSubtotal( $item ) ); ?></div>
                </td>
            </tr>



       <?php endforeach; ?>

        <tr>
        <td colspan="2"><a href="/shop/cart" class=" btn btn-sm btn-default pull-right">

						Edit Cart</a></td>
        <td></td>
        </tr>
        </tbody>
    </table>
</div>


<div id="totalSummary" style="position:relative">
  <?php echo $this->renderView('Shop/Site/Views::checkout/summary.php'); ?>
</div>

	<?php   ?>
    <div class="row form-group">
    	<?php if (empty($cart->userCoupons())) : \Dsc\System::instance()->get( 'session' )->set( 'site.addcoupon.redirect', '/shop/checkout' ); ?>
        <div class="col-md-12 ">
            <div id="coupon">
                <form role="form" action="./shop/cart/addCoupon" method="post" class="form-inline">
                    <div class="form-group">

                        	<label for="coupon_code">Coupon?&nbsp;</label><br/>
                            <input type="text" name="coupon_code" class="form-control" id="inputCouponCode" placeholder="enter coupon code" no-validation="true">

                                <button class="btn btn-default" type="submit">Apply</button>


                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php  ?>

    <div class="row form-group">

        <div class="col-md-12 ">
            <div id="giftcard">
                <form role="form" action="./shop/cart/addGiftCard" method="post" class="form-inline">
                    <div class="">

                        	<label for="giftcard_code">Giftcard?&nbsp;</label>
                        	<br/>

                            <input type="text" name="giftcard_code" class="form-control" id="inputCouponCode"  placeholder="enter card number"   no-validation="true">

                            <input type="text" name="giftcard_pin" class="form-control" id="inputCouponCode" size="8" placeholder="enter pin" no-validation="true">

                            <button class="btn btn-default" type="submit">Apply</button>

                    </div>
                </form>
            </div>
        </div>

    </div>

<div class="well">
	<h3 class="fgGrey">HAVE QUESTIONS ABOUT YOUR ORDER?</h3>
	<ul class="list-group">
	  <li class="list-group-item"><strong class="fgGrey">When will my order ship?</strong><br/><small><i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Orders with all in-stock items ship within 24 hours.</small></li>
	  <li class="list-group-item"><strong class="fgGrey">What about returns?</strong><br/><small><i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Most products are backed by our 30 day no questions asked guarantee.<br/><small>* See our returns page for full details.</small></small></li>
	  <li class="list-group-item"><strong class="fgGrey">More questions?</strong><br/><small><a href="" onclick="return SnapEngage.startLink();" class="fgblue">Live Chat</a> or Call us at <a href="tel:+18884572559" class="fgblue">888-45-RALLY</a><br><small>M-F 8AM-MIDNIGHT / SAT 10AM-10PM / SUN 10AM-8PM MST</small></small></li>

	</ul>
	<div class="paddingBottom  text-center">
		<i href="#" class="sprite sprite-guarantee-light text-center sprite-inline"></i>
	</div>
</div>
