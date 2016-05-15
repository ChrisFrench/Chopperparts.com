
<script charset="utf-8" type="text/javascript">
  <?php echo $this->renderView('Theme/Views::common/richrevelance.php'); ?>
  // here's an example requesting recommendations for 3 page areas
  R3_COMMON.addPlacementType('wishlist_page.rr1');
  R3_COMMON.addPlacementType('wishlist_page.rr2');
  R3_COMMON.addPlacementType('wishlist_page.rr3');

  var R3_WISHLIST = new r3_wishlist();
  <?php if (!empty($wishlist->items)) :  ?>
	  <?php foreach ($wishlist->items as $key=> $item) : ?>

	  	R3_WISHLIST.addItemId('<?php echo   \RallyShop\Models\Products::couldinaryTag(\Dsc\ArrayHelper::get($item, 'model_number')); ?>');
	  <?php endforeach;?>
  <?php endif;?>
  r3();
</script>

	<ol class="breadcrumb row">
        <li>
            <a href="./shop/account">My Account</a>
        </li>
        <li class="active">My Wishlist</li>
    </ol>

<?php if (empty($wishlist->items)) :  ?>

<h2>
	Your wishlist is empty!</a>
</h2>

<?php else : ?>

<h2>
	My wishlist</a>
</h2>


 <div class="row">
		<div class="col-xs-12" id="wishListEmailBox">

		<form class="form-inline" action="/shop/wishlist/send" method="POST" id="wishListEmail">
			  <div class="form-group">
			    <label for="exampleInputName2">Email Wishlist:&nbsp;&nbsp;</label>
			    <input type="email" name="email" required class="form-control" id="email">
			  </div>
			  <button type="submit" class="btn btn-default">Send Wishlist</button>
		</form>

		</div>
</div>
<hr>


    <?php foreach ($wishlist->items as $key=>$item) { ?>

<?php $product = $wishlist->product( $item ); ?>


		<div class=" productItem paddingBottom noCompare col-xs-12 col-lg-3 col-md-3 col-sm-3">

			<?php if (\Dsc\ArrayHelper::get($item, 'image')) { ?>
			<br/>
			    <div class="productImg">
		            <a href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>">
		                <img  class="img-responsive" src="<?php echo  \RallyShop\Models\Products::product_thumb(\Dsc\ArrayHelper::get($item, 'image'));?>" alt="" class="hidden-xs"/>
		            </a>
   				 </div><br/>
   			<?php } else { ?>
   			   <br/>
       		 <div class=" productImg">
	            <a href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>">
	                <img class="img-responsive" src="/theme/img/no-photo.png">
	           	 </a>
       		 </div>
 			<br/>
			<?php } ?>

			<div class=" vcenter productName"><a href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>"><h5 class="marginTopNone gridTitle"><strong itemprop="name"><?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?></strong></h5></a>
                <?php if (\Dsc\ArrayHelper::get($item, 'model_number') == 'RSD 50101'):
                    $email = \Dsc\ArrayHelper::get($item, 'email');
                 ?>
                    Recipient: <?php echo $email ?>
                <?php endif; ?>
        			<div class=" paddingTop">

				<?php if (!\Base::instance()->get('isFrontCounter') || $item['stockstatus'] == 'instock') : ?>
					<a class="wishListAdd btn btn-warning btn-xs"
						data-product-sku="<?php echo  \Dsc\ArrayHelper::get($item, 'sku'); ?>"
						data-product-variant="<?php echo \Dsc\ArrayHelper::get($item, 'attribute_title'); ?>"
						data-product-name="<?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?>"
						href="./shop/wishlist/<?php echo $wishlist->id; ?>/cart/<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>"
						data-button="add-to-cart">Add To Cart
					</a>
				<?php endif; ?>
				<br/>
				<a href="./shop/wishlist/remove/<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>" class="marginTop btn btn-default btn-xs fgBlue">Remove from Wishlist
				</a>

				</div>	<br/>
        		<h5 class="price paddingTop">
		        	<a href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>">
		            	<strong><?php echo \Shop\Models\Currency::format( \Dsc\ArrayHelper::get($item, 'price') ); ?></strong>
		            </a>
			  	</h5>
            </div>




	</div>

<?php } ?>


<?php endif; ?>
