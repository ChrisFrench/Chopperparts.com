<div class="total-box summary paddingTop">

	    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <td  class="col-xs-10"><div class="strong">Subtotal:</div></td>
                    <td><div class="price"><?php echo \Shop\Models\Currency::format( $cart->subtotal() ); ?></div></td>
                </tr>
                <?php if ($user_coupons_nonshipping = $cart->userCoupons(false)) {
                             \Dsc\System::instance()->get( 'session' )->set( 'site.removecoupon.redirect', '/shop/checkout' ); ?>
                    <?php foreach ($user_coupons_nonshipping as $coupon) { ?>
                        <tr class="coupon">
                            <td>
                                <div class="row">
                                    <div class="col-xs-8"><div class="strong">Coupon:<br/><?php echo $coupon['code']; ?></div></div>
                                    <div class="col-xs-4"><a href="./shop/cart/removeCoupon/<?php echo $coupon['code']; ?>"><i class="glyphicon glyphicon-remove"></i></a></div>
                                </div>
                            </td>
                            <td class="col-xs-6">
                                <div class="price">-<?php echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($coupon, 'amount') ); ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>

                <?php if ($autocoupons_nonshipping_discount = $cart->autoDiscountTotal(true)) { ?>
                    <tr class="auto_discount">
                        <td>
                            <div class="strong">Discount:</div>
                        </td>
                        <td class="col-xs-6">
                            <div class="price">-<?php echo \Shop\Models\Currency::format( $autocoupons_nonshipping_discount ); ?></div>
                        </td>
                    </tr>
                <?php } ?>

                <tr>
                    <td><div class="strong">
                            Shipping:
                        </div></td>
                    <td><div class="price">
                        <?php

                        $shippingTotal = $cart->shippingTotal();
                        $shippingCost = $cart->shippingTotalCost();

                        $shippingDiscount = $cart->shippingTotalDiscount();

                        if(!empty($shippingCost)) {
                        	echo \Shop\Models\Currency::format($shippingCost);
                        } else {
							if(!empty($shippingTotal)) {
								echo \Shop\Models\Currency::format($shippingTotal);
							} else {
								echo \Shop\Models\Currency::format(0);
							}

                        }
                        ?>
                    </div></td>
                </tr>



                <?php if ($user_coupons_shipping = $cart->userCoupons(true)) {
                    \Dsc\System::instance()->get( 'session' )->set( 'site.removecoupon.redirect', '/shop/checkout' ); ?>
                    <?php foreach ($user_coupons_shipping as $coupon) { ?>
                        <tr class="coupon">
                            <td>
                                <div class="row">
                                    <div class="col-xs-12"><div class="strong">Shipping Coupon:<br/><?php echo $coupon['code']; ?></div></div>
                                         </div>
                            </td>
                            <td class="col-xs-6">
                                <div class="price">-<?php echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($coupon, 'amount') ); ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>

                <?php if (!empty($shippingDiscount)) { ?>
                    <tr class="auto_discount">
                        <td>
                            <div class="strong">Shipping Discount:</div>
                        </td>
                        <td class="col-xs-6">
                            <div class="price">-<?php echo \Shop\Models\Currency::format( $shippingDiscount ); ?></div>
                        </td>
                    </tr>


				<tr>
                    <td><div class="strong">
                            Shipping Total:
                        </div></td>
                    <td><div class="price">
                        <?php echo \Shop\Models\Currency::format($shippingTotal); ?>
                    </div></td>
                </tr>
                <?php } ?>
                <?php if ($credit = $cart->creditTotal()) { ?>
                    <tr class="auto_discount">
                        <td>
                            <div class="strong">Store Credit:</div>
                        </td>
                        <td class="col-xs-6">
                            <div class="price">-<?php echo \Shop\Models\Currency::format( $credit ); ?></div>
                        </td>
                    </tr>
                <?php } ?>

                <tr>
                    <td><div class="strong">
                            <span data-toggle="tooltip" data-placement="top" title="Taxable amount: <?php echo \Shop\Models\Currency::format( $cart->taxableTotal() ); ?>">
                            Tax:
                            </span>
                        </div></td>
                    <td><div class="price">
                        <span data-toggle="tooltip" data-placement="top" title="Taxable amount: <?php echo \Shop\Models\Currency::format( $cart->taxableTotal() ); ?>">
                        <?php echo \Shop\Models\Currency::format( $cart->taxTotal(true) ); ?>
                        </span>
                    </div></td>
                </tr>
                <?php if ($giftcards = $cart->giftcards) { \Dsc\System::instance()->get( 'session' )->set( 'site.removegiftcard.redirect', '/shop/checkout' ); ?>
                    <?php foreach ($giftcards as $giftcard) { ?>
                        <tr class="giftcard">
                            <td>
                                <div class="row">
                                    <div class="col-xs-8"><div class="strong">Gift Card</div></div>
                                    <div class="col-xs-4"><a href="./shop/cart/removeGiftCard/<?php echo $giftcard['code']; ?>"><i class="glyphicon glyphicon-remove"></i></a></div>
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
                <tr>
                    <td><strong>Total:</strong></td>
                    <td><strong  id="checkOutTotal" class=""><?php echo \Shop\Models\Currency::format( $cart->total() ); ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
