<?php
 if (empty($methods)) 
{	
		if(!empty($message)) : ?>
		
			<div class="form-group has-error">
	    	   <label class="control-label"><?php echo $message; ?></label>
	    	   <input data-required="true" type="hidden" name="checkout[shipping_method]" value="" class="form-control" disabled />
	    	</div>  
		<?php else : ?>
		
	    <?php if ($cart->validShippingAddress()) { ?>
	    	<div class="form-group has-error">
	    	   <label class="control-label">Unfortunately, we cannot ship to your address.</label>
	    	   <input data-required="true" type="hidden" name="checkout[shipping_method]" value="" class="form-control" disabled />
	    	</div>    
		<?php } else { ?>
	    	<div class="form-group has-error">
	    	   <label class="control-label">Please enter your address to view shipping methods.</label>
	    	   <input data-required="true" type="hidden" name="checkout[shipping_method]" value="" class="form-control" disabled />
	    	</div>	
		<?php
		}
		endif; ?>
<?php 	
}
else 
{
    ?>
    <div class="table-responsive">
    <table class="table condensed">
            <thead>
    <?php

    $shipping_discount = 0;
	foreach ($methods as $method_array) 
    {
        ?>
     	 <tr <?php if (\Dsc\ArrayHelper::get( $cart, 'checkout.shipping_method' ) == $method_array['id']) { echo 'class="active"'; } ?>>
         	<td width="55%">
				<label class="radio control-label <?php echo strtolower(str_replace('.', ' ',$method_array['id'])); ?>">
					<input class="shippingmethod" id="<?php echo $method_array['id']; ?>" required="required" type="radio" name="checkout[shipping_method]" value="<?php echo $method_array['id']; ?>" <?php if (\Dsc\ArrayHelper::get( $cart, 'checkout.shipping_method' ) == $method_array['id']) { echo 'checked'; } ?> />
					<?php echo $method_array['name']; ?>
					<?php if(@$method_array['timeInTransit']) : ?><br><small> ETA : <?php echo $method_array['timeInTransit']; ?></small> <?php endif;?>
				</label>	
			</td>
			<td class="text-center">
				<label class="control-label" for="<?php echo $method_array['id']; ?>" id="<?php echo $method_array['id']; ?>" >
					<?php

					if($method_array['discount'] > 0): ?>
									
						<?php 
						$shipping_discount = $method_array['discount'];
						//$percentage = ($method_array['price'] + $method_array['discount'])/$method_array['discount'];
						
						//$percentage = round($percentage,2);
						if ($method_array['price'] < 0.01) { 
							
							
								echo '<small>Customer Pays:</small>     <strong>FREE</strong>';
								echo '<br/><small>Discount:</small>     <span class="shippingDiscount">( ' .\Shop\Models\Currency::format( $method_array['discount']) . ')</span>';
						//		echo '<br/><small>Discount %:</small>     <span class="shippingPercent">( ' .$percentage . ')</span>';
								echo '<br/><small>SHIP TOTAL:</small>    <span class="shippingTotalPrice" data-price="'.($method_array['price'] + $method_array['discount']).'">  ' .\Shop\Models\Currency::format($method_array['price'] + $method_array['discount']) . '</span>';
								
						} else {
								echo '<small>Customer Pays:</small>            <strong>' . \Shop\Models\Currency::format($method_array['display_price'] ) . '</strong>'; 
								echo '<br/><small>Discount:</small>            <span class="shippingDiscount">( ' .\Shop\Models\Currency::format( $method_array['discount']) . '  )</span>';
							//	echo '<br/><small>Discount %:</small>     <span class="shippingPercent">( ' .$percentage . ')</span>';
								echo '<br/><small>SHIP TOTAL:</small><span class="shippingTotalPrice" data-price="'.($method_array['price'] + $method_array['discount']).'">' .\Shop\Models\Currency::format($method_array['price'] + $method_array['discount']) . '  </span>';
																
						} ?>
						
						<?php else : ?>
								
											
										 <?php if ($method_array['price'] < 0.01) {
										 echo '<small>Customer Pays:</small>            <strong>' . \Shop\Models\Currency::format(@$method_array['display_price'] ) . '</strong>';
										 echo '<br/><small>Discount:</small>            <span class="shippingDiscount">( ' .\Shop\Models\Currency::format( @$method_array['discount']) . '  )</span>';
										 //	echo '<br/><small>Discount %:</small>     <span class="shippingPercent">( ' .$percentage . ')</span>';
										 echo '<br/><small>SHIP TOTAL:</small><span class="shippingTotalPrice" data-price="'.($method_array['price'] + @$method_array['discount']).'">' .\Shop\Models\Currency::format($method_array['price'] + $method_array['discount']) . '  </span>';
										 	
										 
										 } 
										 
										 else { 
										 	
										 	echo '<small>Customer Pays:</small>            <strong>' . \Shop\Models\Currency::format(@$method_array['display_price'] ) . '</strong>';
										 	echo '<br/><small>Discount:</small>            <span class="shippingDiscount">( ' .\Shop\Models\Currency::format( @$method_array['discount']) . '  )</span>';
										 	//	echo '<br/><small>Discount %:</small>     <span class="shippingPercent">( ' .$percentage . ')</span>';
										 	echo '<br/><small>SHIP TOTAL:</small><span class="shippingTotalPrice" data-price="'.($method_array['price'] + @$method_array['discount']).'">' .\Shop\Models\Currency::format($method_array['price'] + $method_array['discount']) . '  </span>';
										 		
										 } ?>
						
						<?php endif; ?>
				</label>
			</td>        
   <?php } ?>
    	</tr>  
	</thead>
	</table>
	</div>
	
	<div class="total-box summary">

	    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <td><div class="strong">Subtotal:</div></td>
                    <td><div class="price"><?php echo \Shop\Models\Currency::format( $cart->subtotal() ); ?></div></td>
                </tr>
                <?php 
                $total_coupon = 0;  
                if ($user_coupons_nonshipping = $cart->userCoupons(false)) { 
                             \Dsc\System::instance()->get( 'session' )->set( 'site.removecoupon.redirect', '/shop/checkout' ); ?>
                    <?php

                   
                     foreach ($user_coupons_nonshipping as $coupon) {

                    	
                    	?>
                        <tr class="coupon">
                            <td>
                                <div class="row">
                                    <div class="col-xs-8"><div class="strong">Coupon:<br/><?php echo $coupon['code']; ?></div></div>
                                    
                                </div>
                            </td>
                            <td class="col-xs-6">
                                <div class="price">-<?php echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($coupon, 'amount') ); ?></div>
                            </td>                            
                        </tr>
                    <?php
                    $total_coupon = $total_coupon + \Dsc\ArrayHelper::get($coupon, 'amount');
                     } ?>
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
                            Shipping: <small>(est)</small>
                        </div></td>
                    <td><div id="shippingPriceTotal" class="price">
                        <?php if (!$shippingMethod = $cart->shippingMethod()) {
                            echo \Shop\Models\Currency::format( $cart->shippingEstimate() );
                          
                        } else {
                        	if($shippingMethod->total() == "0.00") {
                        		echo "FREE";
                        	} else {
                        		echo \Shop\Models\Currency::format( $shippingMethod->total() );
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
                
                <?php if ($autocoupons_shipping_discount = $cart->autoShippingDiscountTotal()) { ?>
                    <tr class="auto_discount">
                        <td>
                            <div class="strong">Shipping Discount:</div>
                        </td>
                        <td class="col-xs-6">
                            <div class="price">-<?php echo \Shop\Models\Currency::format( $autocoupons_shipping_discount ); ?></div>
                        </td>                            
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
                
                   
           		 <?php  if ($total_coupon ||  $shipping_discount ) { ?>

                    <tr class="total_discount">
                        <td>
                            <div class="strong">Total Discount Amount:</div>
                        </td>
                        <td class="col-xs-6">
                            <div class="price">-<?php echo \Shop\Models\Currency::format( $total_coupon + $shipping_discount); ?></div>
                            
                        </td>                            
                    </tr>
                <?php } ?>      
                
                
                <tr>
                    <td><div class="strong">
                            <span data-toggle="tooltip" data-placement="top" title="Taxable amount: <?php echo \Shop\Models\Currency::format( $cart->taxableTotal() ); ?>">
                            Tax: <small>(est)</small>
                            </span>
                        </div></td>
                    <td><div class="price">
                        <span data-toggle="tooltip" data-placement="top" title="Taxable amount: <?php echo \Shop\Models\Currency::format( $cart->taxableTotal() ); ?>">
                        <?php if (!$shippingMethod = $cart->shippingMethod()) {
                            echo \Shop\Models\Currency::format( $cart->taxEstimate() );
                           
                        } else {
                        	echo \Shop\Models\Currency::format( $cart->taxTotal() );
                        }
                        ?>
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
                    <td><strong>
                            Total<?php if (!$shippingMethod = $cart->shippingMethod()) { ?> <small>(est)</small> <?php } ?>:
                        </strong></td>
                    <td><strong  id="checkOutTotal" class="fgOrange"><?php echo round($cart->total(), 2); ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
	
	
	<h2>Packages</h2>
	<table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Length</th>
                <th>Width</th>
                <th>Height</th>
                <th>Weight</th>
                <th>Value</th>
                <th>Ships OE</th>
            </tr>
        </thead>
        <?php foreach($packages  as $package) : ?>
            <tr>
                <td> <?php echo $package['dimension']['length'] ?> in</td>
                <td> <?php echo $package['dimension']['width'] ?> in</td>
                <td> <?php echo $package['dimension']['height'] ?> in</td>
                <td> <?php echo $package['weight']['value'] ?> lbs</td>
                <td> <?php echo \Shop\Models\Currency::format($package['declaredValueAmount']['amount']);  ?></td>
                <td> <?php echo $package['oem'] ? 'yes' : '' ?></td>
            </tr>
        <?php endforeach;?>
	</table>
	<?php
}
?>


