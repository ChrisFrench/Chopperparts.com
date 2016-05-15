 <!--Start id tz header-->
        <header id="tz-header" class="bk-white">
            <div class="container">
                <!--Start class header top-->
                <div class="header-top">
                    <?php echo  \Modules\Factory::render( 'left-top-header', \Base::instance()->get('PARAMS.0') ); ?>
                    <ul class="pull-left">
                        <li>
                            <a href="#">Call us:   (012) 3456 7890</a>
                        </li>
                    </ul>
                        <?php echo  \Modules\Factory::render( 'top-nav', \Base::instance()->get('PARAMS.0') ); ?>
                    <ul class="pull-right">
                        <li>
                            <a href="/account">My Account</a>
                        </li>
                        <li>
                            <a href="#">Wishlist</a>
                        </li>
                        <li>
                            <a href="/shop/cart">My Cart</a>
                        </li>
                        <li>
                            <a href="/shop/checkout">Checkout</a>
                        </li>
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

                        <!--live search-->
                        <div class="live-search">
                            <ul>
                                <li>
                                    <div class="live-img"><img src="/theme/images/product/product-search1.jpg" alt="product search one"></div>
                                    <div class="live-search-content">
                                        <h6><a href="single-product.html">Defy Advanced</a></h6>
                                        <span class="live-meta">
                                            <a href="single-product.html">$2650.00</a>
                                            <span class="product-color">
                                                <i class="light-blue"></i>
                                                <i class="orange"></i>
                                                <i class="orange-dark"></i>
                                            </span>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="live-img"><img src="/theme/images/product/product-search2.jpg" alt="product search two"></div>
                                    <div class="live-search-content">
                                        <h6><a href="single-product.html">Defy Advanced</a></h6>
                                        <span class="live-meta">
                                            <a href="single-product.html">$2650.00</a>
                                            <span class="product-color">
                                                <i class="light-blue"></i>
                                                <i class="orange"></i>
                                                <i class="blueviolet"></i>
                                                <i class="orange-dark"></i>
                                            </span>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="live-img"><img src="/theme/images/product/product-search3.jpg" alt="product search one"></div>
                                    <div class="live-search-content">
                                        <h6><a href="single-product.html">Defy Advanced</a></h6>
                                        <span class="live-meta">
                                            <a href="single-product.html">$2650.00</a>
                                            <span class="product-color">
                                                <i class="blueviolet"></i>
                                                <i class="light-blue"></i>
                                                <i class="orange-dark"></i>
                                                <i class="orange"></i>
                                            </span>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--End live search-->
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