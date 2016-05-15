<?php if (\Dsc\ArrayHelper::get($item, 'image')) { ?>
									                                    <a href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>">
									                                        <img src="<?php echo  \RallyShop\Models\Products::product_thumb(\Dsc\ArrayHelper::get($item, 'image'));?>" alt="" class="col-xs-3 hidden-xs" />
									                                    </a>
								                                    <?php } ?>
								                                    
								                                    <h5 class="marginTopNone">
								                                        <a href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>"><?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?><br/><small><?php echo \Dsc\ArrayHelper::get($item, 'model_number'); ?></small></a>
								                                        <?php if (\Dsc\ArrayHelper::get($item, 'attribute_title')) { ?>
								                                        <div><small><?php echo \Dsc\ArrayHelper::get($item, 'attribute_title'); ?></small></div>
								                                        <?php } ?>                                            
								                                    </h5>
							                                    
								                                    <div class="col-xs-8 details paddingLNone paddingRNone">
									                                    <?php switch (\RallyShop\Models\Products::variantInstock($item['product_id'], $item['variant_id'])) : 
		
																		case 'instock': ?>
																			In Stock: Ships the Same Day</strong>
																		<?php break; ?>
																		<?php case 'outofstock': ?>
																			Out of Stock: Ships Soon</strong>									
																		<?php break; ?>
																		<?php //NOTE ONORDER IS NOT BUILT YET ?>
																		<?php case 'onorder': ?>
																			Out of Stock: Ships Soon</strong>
																		<?php break; ?>
													
														 				<?php	endswitch; ?>
									                                    
									                                    
									                                    <br/>
									                                    
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
									                                        	}	else {
									                                        	
										                                        $ymms = @$item['product']['ymms'];
										                                        if(is_array($ymms) && $active['slug']) {
										                                        	$fit = false;
										                                        	
										                                        		foreach($ymms as $vehicle) :
										                                        			if($active['slug'] == $vehicle['slug']) { ?>
										                                        			<div class="">
										                                        				<small class="text-success">
																									Fits your: <strong><?php echo $vehicle['title']; ?> </strong> 
																									
																								</small>
																								<?php if (!empty($vehicle['notes'])) :?>
																								
																									<small class="ymmsNotes"> ( <?php  echo   $vehicle['notes']; ?> )
																								</small>
																									<?php endif;?>
																							 </div>	
										                                        			<?php $fit = true;
																							break;
										                                        		}
										                                        		endforeach;	
										                                        
										                                        	
										                                        	if(!$fit) {
									                                        		echo $this->renderView ( 'Shop/Site/Views::cart/fitments/nofit.php' );
										                                        
										                                        	}
										                                        } 
									                                        }
									                                        
									                                        }
		
									                                        ?>