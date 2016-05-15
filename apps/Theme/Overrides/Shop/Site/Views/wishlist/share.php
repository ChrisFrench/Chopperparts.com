
<?php $wishlist = $item; ?>


	
<?php if (empty($wishlist->items)) :  ?>

<h2>
	Your wishlist is empty!</a>
</h2>

<?php else : ?>

<h1>
Wishlist for <?php echo $user->fullName(); ?> 
</h1>


    <?php foreach ($wishlist->items as $key=>$item) { ?>
    <div class="row paddingTop">

	
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-2 col-sm-3 col-md-3 hidden-xs">
					<figure>
                                <?php if (\Dsc\ArrayHelper::get($item, 'image')) { ?>
                                <a
							href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>">
							
							<img src="<?php echo  \RallyShop\Models\Products::product_thumb(\Dsc\ArrayHelper::get($item, 'image'));?>" alt="" class="img-responsive" />
							
							
						</a>
                                <?php } ?>
                            </figure>
				</div>
				<div class="col-xs-12  col-lg-6">
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



		<div class="col-xs-12 col-lg-3">

				
				
					<form action="./shop/cart/add" method="post" class="addToCartForm">
		                    <input type="hidden" name="variant_id" value="<?php echo $item['variant_id']; ?>" class="variant_id" />
							<input type="hidden" class="form-control" value="1" placeholder="Quantity" name="quantity" id="quantity" />
							<button class="btn btn-warning btn-block addToCartButton">
								<i class="glyphicon glyphicon-shopping-cart"></i> ADD TO CART
							</button>
		 			</form>
				
				
		</div>
	</div>
</div>
			</div>
	<hr>
<?php } ?>
    

<?php endif; ?>

