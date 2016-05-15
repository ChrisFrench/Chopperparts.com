<?php $step = $this->app->get('step'); ?>

<div id="checkout-shipping-address">
	<fieldset>
	<legend>
            <small><strong class="fgBlue">Step <?php echo ++$step; ?>: Shipping Address</strong></small>
	</legend>
	  
     
            <?php
				if ($existing_addresses = \RallyShop\Models\CustomerAddresses::fetch ()) :
			?>
			
						            <div class="form-group" id="shippingSelect">
						
								<select name="checkout[shipping_address][id]" class="form-control"
									id="select-shipping-address">
									<option selected>Select Existing Address</option>
						
						                    
						
						                <?php foreach ($existing_addresses as $address) { ?>
						                    <option value="<?php echo $address->id; ?>"
										data-name="<?php echo htmlspecialchars( $address->name ); ?>"
										data-line_1="<?php echo htmlspecialchars( $address->line_1 ); ?>"
										data-line_2="<?php echo htmlspecialchars( $address->line_2 ); ?>"
										data-city="<?php echo htmlspecialchars( $address->city ); ?>"
										data-region="<?php echo htmlspecialchars( $address->region ); ?>"
										data-country="<?php echo htmlspecialchars( $address->country ); ?>"
										data-postal_code="<?php echo htmlspecialchars( $address->postal_code ); ?>"
										data-phone_number="<?php echo htmlspecialchars( $address->phone_number ); ?>"
										<?php if ( $cart->{'checkout.shipping_address.id'} == $address->id) { echo 'selected="selected"'; } ?>>
						                        <?php echo $address->asString(', '); ?>
						                    </option>
						                <?php } ?>
						                </select>
								</optgroup>
								<hr />
							</div>
            <?php endif; ?>
            
            <div id="shippingForms">


				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="form-group required">
							<label for="shipping_name">Full Name <span class="required-icon"></span></label>
							<input autocompletetype="full-name" x-autocompletetype="full-name" id="shipping_name" type="text" class="form-control name trkInput"
								required="required" name="checkout[shipping_address][name]"
								value="<?php echo $cart->{'checkout.shipping_address.name'}; ?>"
								placeholder="Full Name" required="required" >
						</div>
					</div>

				</div>
				<span id="requiredToGetShippingRates">
				<div class="row">
					<div class="col-sm-8 col-xs-12">
						<div class="form-group required">
							<label for="line_1">Address <span class="required-icon"></span></label>
							<input autocompletetype="street-address" x-autocompletetype="street-address" id="shipping_line_1" type="text" class="form-control address"
								data-required="true" name="checkout[shipping_address][line_1]"
								value="<?php echo $cart->{'checkout.shipping_address.line_1'}; ?>" 
								placeholder="Address"
								autocompletetype="address-line1"
							 	x-autocompletetype="address-line1"
							   required>
						</div>
					</div>
					<div class="col-sm-4 col-xs-12">
						<div class="form-group">
						<label for="line_2">Apt/Unit <small>(Optional)</small></small></label> <input id="shipping_line_2"
							type="text" class="form-control address"
							name="checkout[shipping_address][line_2]"
							value="<?php echo $cart->{'checkout.shipping_address.line_2'}; ?>"
							placeholder="Apt/Unit"
							autocompletetype="address-line2"
							 x-autocompletetype="address-line2" >
							
						</div>
					</div>
				</div>				
				

		
	

		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
					<label for="city">City</span></label> <input id="shipping_city"
						type="text" class="form-control city"
						name="checkout[shipping_address][city]"
						value="<?php echo $cart->{'checkout.shipping_address.city'}; ?>"
						placeholder="City"
						autocompletetype="city"
						x-autocompletetype="city"
						  required>
				</div>
			</div>
		</div>
		<div class="row">	
			<div class="col-sm-4 col-xs-12">
				<div class="form-group ">
					<label for="shipping-country">Country</label> <select
					autocompletetype="country-name"
						x-autocompletetype="country-name"
						class="form-control country" required="required"
						name="checkout[shipping_address][country]" id="shipping_country"  required>
		                    <?php foreach (\Shop\Models\Countries::defaultList() as $country) { ?>
		                        <option
							data-requires_postal_code="<?php echo $country->requires_postal_code; ?>"
							value="<?php echo $country->isocode_2; ?>"
							<?php if ($cart->shippingCountry() == $country->isocode_2) { echo "selected"; } ?>><?php echo $country->name; ?></option>
		                    <?php } ?>
		                    </select>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="form-group required">
					<label for="shipping-region">State/Province</span></label>
					<?php $regions = \Shop\Models\Regions::byCountry( $cart->shippingCountry() ); ?>
					
					 <select
						class="form-control region" required="required"
						autocompletetype="state"
						x-autocompletetype="state"
						name="checkout[shipping_address][region]" id="shipping_region"
						
						
					    <?php echo \Shop\Models\Countries::fromCode($cart->shippingCountry())->regions_disabled ? ' disabled="disabled"' : ' required="required"'; ?>
				
						><option value="" style="display: none"> - Please Select - </option>
		                    <?php foreach (\Shop\Models\Regions::byCountry( $cart->shippingCountry() ) as $region) { ?>
		                        <option value="<?php echo $region->code; ?>"
							<?php if ($cart->{'checkout.shipping_address.region'} == $region->code) { echo "selected"; } ?>><?php echo $region->name; ?></option>
		                    <?php } ?>
		                    </select>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="shipping_postal_code">Zip/Postal Code <span
						class="required-icon"></span></label> <input
						id="shipping_postal_code" type="text"
						autocompletetype="postal-code"
						x-autocompletetype="postal-code"
						class="form-control postal-code"
						<?php echo \Shop\Models\Countries::fromCode($cart->shippingCountry())->requires_postal_code ? 'required="required"' : 'disabled="disabled"'; ?>
						name="checkout[shipping_address][postal_code]"
						value="<?php echo $cart->{'checkout.shipping_address.postal_code'}; ?>"
						placeholder="Postal Code"  required>
				</div>
	  		</div>
		</div>
	</span>
		<div class="form-group required">
			<label for="phone_number">Telephone <span class="required-icon"></span></label>
			<input id="shipping_phone_number" type="tel"
				class="form-control phone" data-required="true"
				autocompletetype="tel"
				x-autocompletetype="tel"
				name="checkout[shipping_address][phone_number]"
				value="<?php echo $cart->{'checkout.shipping_address.phone_number'}; ?>"
				placeholder="Phone Number"  required>
		</div>

		<div id="addressSuggestion" style="display: none;">
			<div id="addressSuggestionResults"></div>
		</div>

    </div>
    </fieldset>
<?php if(empty($cart->nonce) ) : ?>  
<fieldset>
    <legend>
        <small><strong class="fgBlue">Step <?php echo ++$step; ?>: Billing Address</strong></small>
    </legend>

    <?php echo $this->renderView('Shop/Site/Views::checkout/billing_address.php'); ?>

</fieldset>
<?php endif; ?>

</div>

<div class="row">
	<div id="checkout-shipping-methods" class="col-sm-12 paddingTop">
		<fieldset>
		<legend>
            <small><strong class="fgBlue">Step <?php echo ++$step; ?>: Shipping Options</strong></small>
		</legend>
		
<!--		--><?php //if ($cart->shippingRequired()) : ?>
			<a class="btn btn-block btn-primary" onclick="return false" href="#" id="selectShippingMethodBtn">Request Shipping Methods</a>
<!--		--><?php //endif; ?>
		<div id="checkout-shipping-methods-container"></div>
		<div id="intlWarn" class="fgGrey"><br/><small><small>Shipments outside of the U.S.A may be subject to tariffs, duties, Customs Fees, value added tax (VAT), etc. These are not included in the shipping charges and will be the buyer's responsibility. The majority of products sold through our website are designed for U.S. vehicle fitment only.</small></small></div> 
      
       <div id="intlMessage" class="fgGrey"  style="display:none;"  ><br/><small><small>
       <?php if($settings->get('shipping.show_international_message'))  : ?>
        <?php echo $settings->get('shipping.international_message'); ?>
        <?php endif;?>
        </small></small></div> 
     	
       <div id="domesticsMessage" style="display:block;"  class="fgGrey" ><br/><small><small>
       <?php if($settings->get('shipping.show_domestic_message'))  : ?> 
       <?php echo $settings->get('shipping.domestic_message'); ?>
		<?php endif;?>
       </small></small></div> 
       
       
        </fieldset>
	</div>
</div>
<br/>

<?php $this->app->set('step', $step); ?>
