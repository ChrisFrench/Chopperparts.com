<div id="checkout-register" class="checkout-form">

	<div class="well well-sm">
				<legend>
					<small>New Customer?</small>
				</legend>

            
				<form class="" method="post" action="/shop/checkout/register">
					<div id="email-password" class="form-group">
					<input type="email"
							name="email_address" class="form-control"
							placeholder="Email Address" x-autocompletetype="email"
							autocomplete="email" required />
						<p id="guest-email-message" class="help-block"><small>Email will only be used
							for order-related communication.</small></p>
					</div>

					<input type="hidden" name="checkout_method" value="guest">
					<button class="btn btn-default custom-button btn-lg btn-block btn-primary" type="submit">Continue with order</button>
				</form>
	</div>
</div>
 