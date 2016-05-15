<div id="checkout-login" class="checkout-form">
    <div class="well well-sm"> 
	        <div class="row">
		            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					                
			                
					                <form action="./login" method="post" class="form" role="form">
					        
						                    <div class="input-group form-group">
						                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						                        <input name="login-username" type="email" class="form-control" placeholder="E-Mail Address" required />
						                    </div>
						                    <div class="input-group form-group">
						                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						                        <input name="login-password" type="password" class="form-control" placeholder="Password" required no-validation="true"/>
						                    </div>            
						                    
						                    <div class="form-group form-group">    
						                        <button class="btn btn-default custom-button btn-lg" type="submit">Sign In</button>
						                        <?php \Dsc\System::instance()->get('session')->set('site.login.redirect', '/shop/checkout');
						                        \Dsc\System::instance()->get( 'session' )->set( 'site.login.failed.redirect', '/shop/checkout' );
						                        ?>
						                    <a class="btn btn-link fgblue" style="color:#1287ff;" href="./user/forgot-password">Forgot your password?</a>
						                    </div>
					                    
					                </form>       			
		            </div>
	        </div>
    </div>
</div>