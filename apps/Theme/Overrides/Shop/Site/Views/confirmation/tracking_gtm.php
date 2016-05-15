<?php if($DEBUG == 0) : ?>


    <script type="text/javascript">
			<?php foreach ($this->order->items as $item) { ?>	
			ga('ec:addProduct', {            // Provide product details in an impressionFieldObject.
				'id': '<?php echo \Dsc\ArrayHelper::get($item, 'model_number'); ?>',                   // Product ID (string).
				'name': '<?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?>', // Product name (string).
				'price': '<?php echo \Dsc\ArrayHelper::get($item, 'price'); ?>',
				'quantity': '<?php echo \Dsc\ArrayHelper::get($item, 'quantity'); ?>',
				'category': '<?php echo \Dsc\ArrayHelper::get($item, 'product.categories.0.title'); ?>',   // Product category (string).
				'brand': '<?php echo \Dsc\ArrayHelper::get($item, 'product.manufacturer.title'); ?>',                // Product brand (string).
				   <?php  if ( !empty($this->order->coupons)){ echo "'coupon':'".$this->order->coupons[0]['code']."'"; } ?>
			});
		<?php } ?>


			ga('ec:setAction', 'purchase', {          // Transaction details are provided in an actionFieldObject.
				  'id': '<?php echo $this->order->number; ?>',                         // (Required) Transaction id (string).
				  'revenue': '<?php echo (float) $this->order->grand_total; ?>',                     // Revenue (currency).
				  'tax': '<?php echo (float) $this->order->tax_total; ?>',                          // Tax (currency).
				  'shipping': '<?php if ($this->order->shipping_total - $this->order->shipping_discount_total > 0) {  echo (float) $this->order->shipping_total - $this->order->shipping_discount_total; } ?>',  
				   <?php  if ( !empty($this->order->coupons)){ echo "'coupon':'".$this->order->coupons[0]['code']."'"; } ?>
			});
	</script>	

	
	<!-- Google Code for 042611 Test Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1071747771;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "2yzhCLWuggIQu6WG_wM";
var google_conversion_value = <?php echo (float) $this->order->grand_total; ?>;
var google_conversion_currency = "USD";
var google_remarketing_only = false;
/* ]]> */
</script>

<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1071747771/?value=1.00&amp;currency_code=USD&amp;label=2yzhCLWuggIQu6WG_wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	
	<!-- START Google Trusted Stores Order -->
<div id="gts-order" style="display:none;" translate="no">

  <!-- start order and merchant information -->
  <span id="gts-o-id"><?php echo $this->order->number; ?></span>
  <span id="gts-o-domain">www.rallysportdirect.com</span>
  <span id="gts-o-email"><?php echo  $this->order->user_email; ?></span>
  <span id="gts-o-country"><?php echo $this->order->{'shipping_address.country'}; ?></span>
  <span id="gts-o-currency">USD</span>
  <span id="gts-o-total"><?php echo (float) round($this->order->grand_total, 2); ?></span>
  <span id="gts-o-discounts"><?php echo (float) round($this->order->discount_total,2); ?></span>
  <span id="gts-o-shipping-total"><?php echo (float) round($this->order->shipping_total, 2); ?></span>
  <span id="gts-o-tax-total"><?php echo (float) round($this->order->tax_total,2); ?></span>  
  <?php
  $country = $this->order->{'shipping_address.country'};
  $shippingDates = (new \RallyShop\Models\ShippingMethods)->getShipDates($country == 'US' ? false : true);

  $shipdate = key(array_pop($shippingDates));
  
  $highestDay = \DateTime::createFromFormat('Y-m-d', $shipdate);
  $shipdate = $highestDay->format('Y-m-d');
  $preorder = 'N';
  //TODO get the actual arrival dates from all carriers
  if($country == 'US') {
  	$arrivalDate = $highestDay->add(new \DateInterval('P5D'))->format('Y-m-d');
  } else {
  	$arrivalDate = $highestDay->add(new \DateInterval('P10D'))->format('Y-m-d');
  }
  
  ?>	

  <span id="gts-o-est-ship-date"><?php echo $shipdate; ?></span>
  <span id="gts-o-est-delivery-date"><?php echo $arrivalDate; ?></span>

  <!-- end order and merchant information -->

  <!-- start repeated item specific information -->
  <!-- item example: this area repeated for each item in the order -->
  <?php foreach ($this->order->items as $item) : ?>
  <span class="gts-item">
    <span class="gts-i-name"><?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?></span>
    <span class="gts-i-price"><?php echo round(\Dsc\ArrayHelper::get($item, 'price'), 2); ?></span>
    <span class="gts-i-quantity"><?php echo \Dsc\ArrayHelper::get($item, 'quantity'); ?></span>
    <span class="gts-i-prodsearch-id"><?php echo \Dsc\ArrayHelper::get($item, 'model_number'); ?></span>
    <span class="gts-i-prodsearch-store-id">465965</span>
    <span class="gts-i-prodsearch-country">US</span>
    <span class="gts-i-prodsearch-language">en</span>
  </span>
  <?php if(\Dsc\ArrayHelper::get($item, 'product.inventory_count') == 0) : ?>
  <?php $preorder = 'Y'; ?>
  <?php endif; ?>
  <?php endforeach; ?>
  
  <span id="gts-o-has-preorder"><?php echo $preorder; ?></span>
  <span id="gts-o-has-digital">N</span>
 
  
  
  

</div>
<!-- END Google Trusted Stores Order -->
  
<?php endif; ?>


<script charset="utf-8" type="text/javascript">
<?php echo $this->renderView('Theme/Views::common/richrevelance.php'); ?>
//here's an example requesting recommendations for 3 page areas
R3_COMMON.addPlacementType('purchase_complete_page.rr1');
//R3_COMMON.addPlacementType('purchase_complete_page.rr2');
//R3_COMMON.addPlacementType('purchase_complete_page.rr3');

var R3_PURCHASED = new r3_purchased();
R3_PURCHASED.setOrderNumber('<?php echo $this->order->number; ?>');
 <?php foreach ($this->order->items as $item) : ?>
R3_PURCHASED.addItemIdPriceQuantity('<?php echo  \RallyShop\Models\Products::couldinaryTag(\Dsc\ArrayHelper::get($item, 'model_number')); ?>', '<?php echo round(\Dsc\ArrayHelper::get($item, 'price'), 2); ?>', '<?php echo \Dsc\ArrayHelper::get($item, 'quantity'); ?>'); // iterate over this line for each item purchased
<?php endforeach; ?>
r3();
</script>
<script charset="utf-8" type="text/javascript">
  r3_placement('purchase_complete_page.rr1');
</script>

<script charset="utf-8" type="text/javascript">
rr_flush_onload();
</script>