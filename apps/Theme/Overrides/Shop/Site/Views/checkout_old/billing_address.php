<?php if ($cart->shippingRequired()): ?>
	<div>
		<label for="useShippingForBilling">
			<input id="useShippingForBilling" name="checkout[billing_address][same_as_shipping]" type="checkbox" checked> My billing address is the same as above.
		</label>
	</div>


	<div id="billing-address-container" style="display:none;">
<?php else: ?>
	<div id="billing-address-container">
<?php endif; ?>
    		 <?php

            if ($existing_addresses = \RallyShop\Models\CustomerAddresses::fetch()) : ?>

            <div class="form-group" id="billingSelect">

                <select name="checkout[billing_address][id]" class="form-control" id="select-billing-address">


                    <option id="new-address" value="new-address">Select Existing Address</option>

                <?php foreach ($existing_addresses as $address) { ?>
                    <option
                        value="<?php echo $address->id; ?>"
                        data-name="<?php echo htmlspecialchars( $address->name ); ?>"
                        data-line_1="<?php echo htmlspecialchars( $address->line_1 ); ?>"
                        data-line_2="<?php echo htmlspecialchars( $address->line_2 ); ?>"
                        data-city="<?php echo htmlspecialchars( $address->city ); ?>"
                        data-region="<?php echo htmlspecialchars( $address->region ); ?>"
                        data-country="<?php echo htmlspecialchars( $address->country ); ?>"
                        data-postal_code="<?php echo htmlspecialchars( $address->postal_code ); ?>"
                        data-phone_number="<?php echo htmlspecialchars( $address->phone_number ); ?>"

                        <?php if ( $cart->{'checkout.billing_address.id'} == $address->id) { echo 'selected="selected"'; } ?>

                    >
                        <?php echo $address->asString(', '); ?>
                    </option>
                <?php } ?>
                </select>
                 </optgroup>
                <hr/>
            </div>
            <?php endif; ?>



             <div id="billingForms">

				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
							<label for="billing_name">Full Name <span class="required-icon"></span></label>
							<input id="billing_name" type="text" class="form-control name trkInput"
								 name="checkout[billing_address][name]"
								value="<?php echo $cart->{'checkout.billing_address.name'}; ?>"
								placeholder="Full Name"  autocomplete="off" <?php echo $cart->shippingRequired() ?: ' required' ?>>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8 col-xs-12">
						<div class="form-group">
							<label for="line_1">Address <span class="required-icon"></span></label>
							<input id="billing_line_1" type="text" class="form-control address"
								name="checkout[billing_address][line_1]"
								value="<?php echo $cart->{'checkout.billing_address.line_1'}; ?>"
								placeholder="Address" autocomplete="off" <?php echo $cart->shippingRequired() ?: ' required' ?>>
						</div>
					</div>
					<div class="col-sm-4 col-xs-12">
						<div class="form-group">
						<label for="line_2">Apt/Unit <small>(Optional)</small></small></label> <input id="billing_line_2"
							type="text" class="form-control address"
							name="checkout[billing_address][line_2]"
							value="<?php echo $cart->{'checkout.billing_address.line_2'}; ?>"
							placeholder="Apt/Unit" autocomplete="off">
						</div>
					</div>
				</div>





		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
					<label for="city">City</span></label> <input id="billing_city"
						type="text" class="form-control city"
						name="checkout[billing_address][city]"
						value="<?php echo $cart->{'checkout.billing_address.city'}; ?>"
						placeholder="City" autocomplete="off" <?php echo $cart->shippingRequired() ?: ' required' ?>>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-xs-12">
				<div class="form-group ">
					<label for="billing-country">Country</label> <select
						class="form-control country"
						name="checkout[billing_address][country]" id="billing_country" autocomplete="off" <?php echo $cart->shippingRequired() ?: ' required' ?>>
		                    <?php foreach (\Shop\Models\Countries::defaultList() as $country) { ?>
		                        <option
							data-requires_postal_code="<?php echo $country->requires_postal_code; ?>"
							value="<?php echo $country->isocode_2; ?>"
							<?php if ($cart->billingCountry() == $country->isocode_2) { echo "selected"; } ?>><?php echo $country->name; ?></option>
		                    <?php } ?>
		                    </select>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="billing-region">State/Province</span></label>
					<?php $regions = \Shop\Models\Regions::byCountry( $cart->billingCountry() ); ?>

					 <select
						class="form-control region"
						name="checkout[billing_address][region]" id="billing_region"
						autocomplete="off" <?php echo $cart->shippingRequired() ?: ' required' ?>><option value="" style="display: none"> - Please Select - </option>
		                    <?php foreach (\Shop\Models\Regions::byCountry( $cart->billingCountry() ) as $region) { ?>
		                        <option value="<?php echo $region->code; ?>"
							<?php if ($cart->{'checkout.billing_address.region'} == $region->code) { echo "selected"; } ?>><?php echo $region->name; ?></option>
		                    <?php } ?>
		                    </select>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="billing_postal_code">Zip/Postal Code <span
						class="required-icon"></span></label> <input
						id="billing_postal_code" type="text"
						class="form-control postal-code" name="checkout[billing_address][postal_code]"
						value="<?php echo $cart->{'checkout.billing_address.postal_code'}; ?>"
						placeholder="Postal Code" autocomplete="off" <?php echo $cart->shippingRequired() ?: ' required' ?>>
				</div>
	  		</div>
		</div>

		<div class="form-group">
			<label for="phone_number">Telephone <span class="required-icon"></span></label>
			<input id="billing_phone_number" type="text"
				class="form-control phone"
				name="checkout[billing_address][phone_number]"
				value="<?php echo $cart->{'checkout.billing_address.phone_number'}; ?>"
				placeholder="Phone Number" autocomplete="off" <?php echo $cart->shippingRequired() ?: ' required' ?>>
		</div>

 </div>
<div id="billingAddressDisplay" class="col-xs-12 paddingTop"></div>