<?php

 if (empty($methods))
{
		if(!empty($message)) : ?>

			<div class="form-group has-error">
	    	   <label class="control-label"><?php echo $message; ?></label>
	    	   <input data-required="true" type="hidden" name="checkout[shipping_method]" value="" class="form-control" disabled />
	    	</div>
		<?php else : ?>

	    <?php if (!$cart->validShippingAddress()) { ?>
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
    <table class="table condensed" style="margin-bottom: 5px;">
            <thead>
    <?php
    $totalMethods = count($methods);
 
    $first = true;

	foreach ($methods as $method_array)
    {
        ?>
        <?php $discount = $method_array['discount'];?>
     	 <tr <?php if ($cart->get('checkout.shipping_method') == $method_array['id']) { echo 'class="shippingMethodRow active"'; } else { echo 'class="shippingMethodRow" style="display:none;"';} ?> class="shippingMethodRow <?php  echo ($first ? 'first' : 'othermethods'); ?>" >
         	<td width="100%">
				<label class="radio control-label <?php echo strtolower(str_replace('.', ' ',$method_array['id'])); ?>">
					<input class="shippingmethod" id="<?php echo $method_array['id']; ?>" required="required" type="radio" name="checkout[shipping_method]" value="<?php echo $method_array['id']; ?>" <?php if (\Dsc\ArrayHelper::get( $cart, 'checkout.shipping_method' ) == $method_array['id']) { echo 'checked'; } ?> />
					<?php echo $method_array['name']; ?>
					<?php if(!empty($method_array['timeInTransit']) && trim($method_array['timeInTransit']) != 'No Commitment') : ?><br><small> ETA : <?php echo $method_array['timeInTransit']; ?></small> <?php endif;?>
				</label>
			</td>
			<td class="text-center">
				<label class="radio control-label" for="<?php echo $method_array['id']; ?>">
					<?php if(!empty($method_array['discount']) && $method_array['discount'] > 0): ?>

										<?php
										if ($method_array['price'] < 0.01) {
												echo '<strong>FREE</strong>';

										} else {
												//echo '<span class="shippingCost">(' .\Shop\Models\Currency::format( $method_array['cost']) . ')</span>';
												echo '<strong>' . \Shop\Models\Currency::format($method_array['display_price'] ) . '</strong>';
												//echo '<br/><span class="shippingDiscount"><small><strike>' .\Shop\Models\Currency::format( $method_array['discount']) . '</small></strike> </span>';
										} ?>

						<?php else : ?>

										 <?php if ($method_array['price'] < 0.01) { echo "FREE"; }
										 else {
										 	echo \Shop\Models\Currency::format($method_array['price'] ); } ?>

						<?php endif; ?>
						<?php if($totalMethods > 1) :  ?>
	<div><a id="additonalMethods" class="btn btn-link fgBlue additonalMethods" style="margin-bottom:0px; margin-right:0px;">More Shipping Options</a></div>
	</div>
	<?php endif; ?>
				</label>
			</td>
			<?php $first = false; ?>
   <?php } ?>
    	</tr>
	</thead>
	</table>

	<?php if($discount > 0.00) :?>
	<div class=" alert-success" style="margin-bottom:0px; background-color: #fff;">
     This orders shipping has been discounted by <strong><?php echo \Shop\Models\Currency::format($discount); ?></strong>
    </div>
	<?php endif;?>

	<?php
}
?>
