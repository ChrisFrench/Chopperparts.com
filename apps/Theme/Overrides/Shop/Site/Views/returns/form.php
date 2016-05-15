<div class="row">
	<div class="col-xs-12 paddingTop">
		<form method="post">
			<h2>Step 1) Select items to return.</h2>
			
			
			
			
			<table class="table table-hover">
      <thead>
        <tr>
       
          <th colspan="2">Description</th>
          <th>Price Each</th>
          <th>Ext. Price</th>
          <th>Return Qty</th>
          <th>Return?</th>
        </tr>
      </thead>
      <tbody>
      
<?php foreach ($items as $key=>$item) {  ?>
						<?php $hash = \Dsc\ArrayHelper::get($item, 'hash');?>	                   
							           
		<tr id="row-<?php echo $hash; ?>">

				<td colspan="2">
					<?php if (\Dsc\ArrayHelper::get($item, 'image')) { ?>
						<a
						href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>">
						<img
						src="<?php echo  \RallyShop\Models\Products::product_thumb(\Dsc\ArrayHelper::get($item, 'image'));?>" alt="" class="col-xs-3 hidden-xs" />
					</a>
					<?php } ?>
				
					<h5 class="marginTopNone">
						<a
							href="./shop/product/<?php echo \Dsc\ArrayHelper::get($item, 'product.slug'); ?>"><?php echo \Dsc\ArrayHelper::get($item, 'product.title'); ?></a>
					
						<?php if (\Dsc\ArrayHelper::get($item, 'attribute_title')) { ?>
							<div>
							<small><?php echo \Dsc\ArrayHelper::get($item, 'attribute_title'); ?></small>
						</div>
						<?php } ?>   
						<br />

					</h5>
					
                                 
						<?php if (\Dsc\ArrayHelper::get($item, 'sku')) { ?>
							<p class="detail-line">
							<label>SKU:</label> <?php echo \Dsc\ArrayHelper::get($item, 'sku'); ?>
							</p>
						<?php } ?>	                                        
					</td>

		


				<td>
					<h4 class="marginTopNone">
						<small><?php  echo \Shop\Models\Currency::format( $item['price'] );?></small>
					</h4>
				</td>
				<td>
					<h4 class="marginTopNone">
						<small><?php  echo \Shop\Models\Currency::format(  $item['price'] * $item['quantity']);?></small>
					</h4>
				</td>
				<td>
					<select
						id="returnSelectQuantity-<?php echo $hash; ?>"
						name="<?php echo $hash; ?>[quantity]"
						disabled="disabled"
						data-hash="<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>">
				 			<?php echo \Dsc\Html\Select::options( range(1,$item['quantity']),'1' ); ?>		
						</select>
				</td>
				<td>
					<input id="returnCheckbox-<?php echo $hash; ?>" type="checkbox" class="returnCheckbox" name="<?php echo $hash; ?>[return]"
						value="<?php echo \Dsc\ArrayHelper::get($item, 'hash'); ?>" id="returnBox-<?php echo $hash; ?>">
				</td>


			</tr>
			<tr id="returnBox-<?php echo $hash; ?>">
			<td colspan="6"class="returnForm bg-warning well text-center"
				id="ret-<?php echo $hash; ?>"
				style="display: none;">
				<div class="returnableForm" id="returnableForm-<?php echo $hash; ?>">
				<div id="unopenedBox-<?php echo $hash; ?>">
 					<strong>Is this item in the bag/box unopened?</strong><br/>
					<select name="<?php echo $hash; ?>[unopened]" class="unopened" data-hash="<?php echo $hash; ?>">
						<option value="" selected="selected">Choose</option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select><br/>
					</div>
					<div id="uninstalledBox-<?php echo $hash; ?>" style="display:none">
	 					<strong>Is this item uninstalled and new?</strong><br/>
						<select name="<?php echo $hash; ?>[uninstalled]" class="uninstalled"  data-hash="<?php echo $hash; ?>">
							<option value="" selected="selected">Choose</option>
							<option value="1">Yes</option>
							<option value="0">No</option>
						</select>
					</div>
				</div>
				<div id="returnReason-<?php echo $hash; ?>" style="display: none;">
			    <div id="returnReasonSelect-<?php echo $hash; ?>">
				<strong>Reason for Return:</strong><br/>
					<select name="<?php echo $hash; ?>[reason]" class="selectReason" data-hash="<?php echo $hash; ?>">
				    	<option value=""></option>
						<option value="No_Longer_Needed">I no longer need this item.</option>
						<option value="Better_Price">I found this item at a better price elsewhere.</option>
				    	<option value="wrong_item_norsd">I received the wrong item.</option>
						<option value="damaged_norsd">This item was delivered damaged.</option>
						<option value="defective_norsd">This item is defective/does not fit.</option>            
						<option value="Recall">Recall.</option>
					</select><br/>
				</div>
					<div id="returnReasonInput-<?php echo $hash; ?>" style="display: none;">
						<strong id="returnReasonQuestion-<?php echo $hash; ?>">Is this item in the bag/box unopened?</strong><br/>
						<textarea class="form-control" rows="3" name="<?php echo $hash; ?>[question]"></textarea>
					</div>
				</div>
				<div id="notReturnable-<?php echo $hash; ?>" class="text-danger" style="display: none;">
					<i class="glyphicon glyphicon-alert"></i>&nbsp;&nbsp;<strong>Does
						not meet our required conditions. Please see our <a
						href="/pages/returns" target="_Blank">Standard Return Policy</a>
					</strong>
				</div>
			</div>
		</tr>
	         
	<?php } ?>
      </tbody>
    </table>
			
				<div class="row">
					<div class="col-xs-12 well text-center">
					<input type="checkbox" id="affirmReturn">
					 I affirm the items listed above are in the exact condition I described previously. <br/>
					 I also understand that my return will be <strong>REFUSED</strong> or <strong>DISCARDED</strong> if it fails to meet all of the Standard Return Policy requirements.<br/>
					 I also understand that I may have a portion of my refund deducted, if I qualified for the DISCOUNTED shipping rate when I originally placed my order.<br>
					 Any customs or duties charges incurred upon returning an international shipment will be charged to the original form of payment.<br>
					 If you have questions regarding our return policy, please click <a href="/pages/returns">HERE</a>
					</div>
				</div>
				<div class="row">
				<div class="col-xs-12 paddingBottom">
					<button type="submit" class="btn btn-primary pull-right" disabled="disabled" id="returnNextStep">Submit Return</button>
				</div>
			</div>

		</form>
	</div>
</div>
