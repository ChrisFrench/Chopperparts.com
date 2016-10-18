 <!--Start id tz header-->
        <header id="tz-header" class="bk-white">
            <div class="container">
                <!--Start class header top-->
                <div class="header-top">
                    <?php echo  \Modules\Factory::render( 'left-top-header', \Base::instance()->get('PARAMS.0') ); ?>
                    <?php /*?>
                    <ul class="pull-left">
                        <li>
                            <a href="#">Call us:   <?php echo \Shop\Models\Settings::fetch()->get('store_address.phone_number'); ?></a>
                        </li>
                    </ul>
                    <?php */ ?>
                        <?php echo  \Modules\Factory::render( 'top-nav', \Base::instance()->get('PARAMS.0') ); ?>
                    <ul class="pull-right">
                        <li>
                            <a href="/shop/account">My Account</a>
                        </li>
                        <li>
                            <a href="/shop/wishlist">Wishlist</a>
                        </li>
                        <li>
                            <a href="/shop/cart">My Cart</a>
                        </li>
                        <li>
                            <a href="/shop/checkout">Checkout</a>
                        </li>
                        <?php $identity = \Dsc\System::instance()->get('auth')->getIdentity(); ?>
                        <?php if(empty($identity->id)) :?>
                        <li class="tz-header-login">
                            <a href="#">Login</a>
                            <div class="tz-login-form">
                                <form action="/login" method="post">
                                    <p class="form-content">
                                        <label for="username">Username / Email</label>
                                        <input type="email" name="login-username" id="username" value="">
                                    </p>
                                    <p class="form-content">
                                        <label for="password">Password</label>
                                        <input type="password" name="login-password" id="password" value="">
                                    </p>
                                    <p class="form-footer">
                                        <a href="./user/forgot-password">Lost Password?</a>
                                        <button type="submit" class="pull-right button_class">LOGIN</button>
                                    </p>
                                    <?php if ($settings->{'general.registration.enabled'}) { ?>
                                    <p class="form-text">
                                        Don't have an account? <a href="./register">Register Here</a>
                                    </p>
                                    <?php } ?>
                                </form>
                            </div>
                        </li>
                        <?php else : ?>
                        <li>
                            <a href="/logout">Logout</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!--End class header top-->

                <!--Start header content-->
                <div class="header-content">
                    <h3 class="tz-logo pull-left"><a href="/"><img src="/theme/images/logo.png" alt="home" /></a></h3>
                    <div class="tz-search pull-right">

                        <!--Start form search-->
                        <form method="GET" action="/search">
                            <input type="text" class="tz-query" id="tz-query" name="q" value="" placeholder="Search for product">
                            <button type="submit"></button>
                        </form>
                        <!--End Form search-->

                        
                    </div>
                </div>
                <!--End class header content-->
            </div>
			
			
			
            <!--Start main menu -->
            <nav class="tz-menu-primary">
                <div class="container">
					<?php echo  \Modules\Factory::render( 'main-nav', \Base::instance()->get('PARAMS.0') ); ?>
                    <!--Main Menu-->
                    
					<?php $cart = \Shop\Models\Carts::fetch(); ?>
                    <!--Shop meta-->
                    <ul class="tz-ecommerce-meta pull-right">
                        
                        <li class="tz-mini-cart">
                            <a href="/shop/cart"><strong><?php echo $cart->quantity; ?></strong>Cart : <?php echo \Shop\Models\Currency::format( $cart->subtotal() ); ?></a>
							
							<?php (new \Shop\Site\Controllers\Cart)->miniCart(); ?>	
                            

                        </li>
                    </ul>
                    <!--End Shop meta-->

                    <!--navigation mobi-->
                    <button data-target=".nav-collapse" class="btn-navbar tz_icon_menu" type="button">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!--End navigation mobi-->
                </div>
            </nav>
            <!--End stat main menu-->

        </header>
        <!--End id tz header-->