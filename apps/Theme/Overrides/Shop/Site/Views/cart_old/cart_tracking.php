<?php
$identity = $this->auth->getIdentity();
if (!empty($identity->email)) {
	$hashedEmail = \Dsc\String::getHashed($identity->email);
} else {
	$hashedEmail = '';
}
?>

<script type="text/javascript" src="//static.criteo.net/js/ld/ld.js" async="true"></script>
<script type="text/javascript">
	window.criteo_q = window.criteo_q || [];
	var deviceType= /iPad/.test(navigator.userAgent)?"t":/Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Silk/.test(navigator.userAgent)?"m":"d";
	window.criteo_q.push(
		{ event: "setAccount", account: 23878 },
		{ event: "setSiteType", type: deviceType },
		{ event: "setHashedEmail", email: ["<?php echo $hashedEmail ?>"] },

		<?php
			$items = [];

			foreach ($cart->items as $item) {
				$items[] = [
					'id' => $item['model_number'],
					'price' => $item['price'],
					'quantity' => $item['quantity']
				];
			}
    	?>
		{ event: "viewBasket", item: <?php echo json_encode($items) ?> }
	);
</script>
<script type="text/javascript">
//This code can actually be used anytime to achieve an "Ajax" submission whenever called
if (typeof StrandsTrack=="undefined"){StrandsTrack=[];}
StrandsTrack.push({
   event:"updateshoppingcart",
   items:[
       <?php foreach ($cart->items as $key=>$item) {  ?>
       "<?php echo \Dsc\ArrayHelper::get($item, 'model_number'); ?>",
       <?php }?>
   ]
});

</script>
<script charset="utf-8" type="text/javascript">
<?php echo $this->renderView('Theme/Views::common/richrevelance.php'); ?>

R3_COMMON.addPlacementType('cart_page.rr1');


var R3_CART = new r3_cart();
<?php foreach ($cart->items as $key=>$item) : ?>
R3_CART.addItemId('<?php echo \RallyShop\Models\Products::couldinaryTag(\Dsc\ArrayHelper::get($item, 'model_number')); ?>'); // iterate over this line for each item in the cart
<?php endforeach; ?>
r3();


</script>
