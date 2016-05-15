<script charset="utf-8" type="text/javascript">

$(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    if(e.target.hash == '#wishlist') {
    	R3_COMMON = new r3_common();
    	R3_COMMON.setApiKey('<?php echo $RichRelApi?>');
    	R3_COMMON.setBaseUrl(window.location.protocol+'//integration.richrelevance.com/rrserver/');
    	R3_COMMON.setClickthruServer(window.location.protocol+"//"+window.location.host);
    	R3_COMMON.setSessionId('<?php echo session_id(); ?>');
    	<?php if($user = $this->auth->getIdentity()) :  ?>
    	 R3_COMMON.setUserId('<?php echo $user->id; ?>');
    	<?php else : ?>
    R3_COMMON.setUserId('');
    	  <?php endif; ?>
  	  // here's an example requesting recommendations for 3 page areas
  	  R3_COMMON.addPlacementType('wishlist_page.rr1');
  	  R3_COMMON.addPlacementType('wishlist_page.rr2');
  	  R3_COMMON.addPlacementType('wishlist_page.rr3');
  	 
  	  var R3_WISHLIST = new r3_wishlist();
  	  <?php if (!empty($wishlist->items)) :  ?>
  		  <?php foreach ($wishlist->items as $key=>$item) : ?>
  		  	R3_WISHLIST.addItemId('<?php echo \Dsc\ArrayHelper::get($item, 'tracking.model_number'); ?>');
  		  <?php endforeach;?>
  	  <?php endif;?>
  	  r3();
       }
});

  

  
</script>
<?php if (empty($wishlist->items)) :  ?>

<h2>
	Your wishlist is empty!</a>
</h2>

<?php else : ?>
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
    <div class="row">

	
		<div class="col-xs-12 col-lg-4">
			<div class="row wishlistItem">
				<div class="col-xs-2 col-sm-3 col-md-2 hidden-xs">
					<figure>
                                <?php if (\Dsc\ArrayHelper::get($item, 'image')) { ?>
									                                    <a href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>">
									                                        <img src="<?php echo  \RallyShop\Models\Products::product_thumb(\Dsc\ArrayHelper::get($item, 'image'));?>" alt="" class="hidden-xs" />
									                                    </a>
								                                    <?php } ?>
                            </figure>
				</div>
				<div class="col-xs-10 col-sm-8 col-md-8 ">
					<div class="text">
						<h5>
							<a
								href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>"><?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?></a>
                                    <?php if (\Dsc\ArrayHelper::get($item, 'attribute_title')) { ?>
                                    <div>
								<small><?php echo \Dsc\ArrayHelper::get($item, 'attribute_title'); ?></small>
							</div>
                                    <?php } ?>                                            
                                </h5>
						<div class="details">
                                    <?php if (\Dsc\ArrayHelper::get($item, 'sku')) { ?>
                                    <span class="detail-line"> <strong>SKU:</strong> <?php echo \Dsc\ArrayHelper::get($item, 'sku'); ?>
                                    </span>
                                    <?php } ?>                            
                                </div>
                                
                                <?php $product = $wishlist->product( $item ); ?>

                                
                                    
                    					<strong class="newPrice fgOrange"><?php echo \Shop\Models\Currency::format( $product->price() ); ?></strong>
                					
					                <?php if (((int) $product->get('prices.list') > 0) && (float) $product->get('prices.list') != (float) $product->price() ) { ?>
					                    <span class="strikePrice"><?php echo \Shop\Models\Currency::format( $product->{'prices.list'} ); ?></span>
					                <?php } ?>
                                                           
                                
					</div>
				</div>



		<div class="col-xs-2 col-sm-1 col-md-1 col-md-offset-1 paddingTopMd">
			<a href="./shop/wishlist/remove/<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>" class=" custom-button wishlistRemove">
				<i class="glyphicon glyphicon-remove x1"></i>
			</a><br />

			<?php if (!\Base::instance()->get('isFrontCounter') || $item['stockstatus'] == 'instock') : ?>
				<a class="wishListAdd"
					data-product-sku="<?php echo  \Dsc\ArrayHelper::get($item, 'sku'); ?>"
					data-product-variant="<?php echo \Dsc\ArrayHelper::get($item, 'attribute_title'); ?>"
					data-product-name="<?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?>"
					href="./shop/wishlist/<?php echo $wishlist->id; ?>/cart/<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>"
					data-button="add-to-cart">
						<i class="glyphicon glyphicon-cart-in x1  marginTopMd"></i>
				</a>
			<?php else: ?>
				Out of Stock
			<?php endif; ?>
		</div>
	</div>
</div>
			</div>
	<hr>
<?php } ?>
    

<?php endif; ?>
