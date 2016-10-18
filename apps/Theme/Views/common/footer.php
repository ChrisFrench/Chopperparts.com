<!--Start Footer-->
        <footer class="tz-footer">
            <div class="footer-widget">
                <div class="container">

                    <!--Start footer left-->
                    <div class="footer-left">
                        <div class="contact-info widget">
                            <h3 class="widget-title">Contact info</h3>
                            <p><?php echo \Shop\Models\Settings::fetch()->get('store.description'); ?></p>
                            <ul>
                                <li>
                                    <span>Address :</span>
                                    <address>
                                        <?php echo \Shop\Models\Settings::fetch()->get('store_address.line_1'); ?> <?php echo \Shop\Models\Settings::fetch()->get('store_address.line_2'); ?>, <?php echo \Shop\Models\Settings::fetch()->get('store_address.city'); ?>, <?php echo \Shop\Models\Settings::fetch()->get('store_address.region'); ?> ,<br><?php echo \Shop\Models\Settings::fetch()->get('store_address.country'); ?> <?php echo \Shop\Models\Settings::fetch()->get('store_address.postal_code'); ?> 
                                    </address>
                                </li>
                                <?php /*?>
                                <li>
                                    <span>Phone :</span>
                                    (012) 345 6789
                                </li>
                                <?php */ ?>
                                <li>
                                    <span>Email :</span>
                                    contact@chopperparts.com
                                </li>
                            </ul>
                        </div>
                        <?php /*?>
                        <div class="widget">
                            <form class="tz-subcribe">
                                <input type="text" name="sub" value="" placeholder="Enter your email...">
                                <input type="submit" name="subscribe" value="Subscribe">
                            </form>
                        </div>
                        <div class="widget">
                            <ul class="tz-social">
                                <li>
                                    <a class="fa fa-facebook" href="#"></a>
                                </li>
                                <li>
                                    <a class="fa fa-twitter" href="#"></a>
                                </li>
                                <li>
                                    <a class="fa fa-google-plus" href="#"></a>
                                </li>
                                <li>
                                    <a class="fa fa-tumblr" href="#"></a>
                                </li>
                                <li>
                                    <a class="fa fa-flickr" href="#"></a>
                                </li>
                                <li>
                                    <a class="fa fa-pinterest" href="#"></a>
                                </li>
                            </ul>
                        </div>
                        <?php */ ?>
                    </div>
                    <!--End footer left-->

                    <!--Start footer right-->
                    <div class="footer-right">
                        <div class="tz-widget-clients widget">
                            <h3 class="widget-title">Free Shipping</h3>
                            <div class="tz-widget-say">
                            <?php /*?>
                                <img src="/theme/images/say.jpg" alt="Kathy Young">
                                <?php */ ?>
                                <div class="">
                                    <p>Free Shipping on all orders over $200 Dollars</p>
                                    <span>Inside the United States Lower 48</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="widget widget_nav_menu">
                                    <h3 class="widget-title">HOW TO BUY</h3>
                                    <ul>
                                        <li>
                                            <a href="/contact-us">Contact Us</a>
                                        </li>
                                        <li>
                                            <a href="/pages/returns">Returns</a>
                                        </li>
                                       
                                        <li>
                                            <a href="/brands">Brands</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget widget_nav_menu">
                                    <h3 class="widget-title">MY ACCOUNT</h3>
                                    <ul>
                                        <li>
                                            <a href="/shop/account">My Account</a>
                                        </li>
                                        <li>
                                            <a href="/shop/account">Order History</a>
                                        </li>
                                        <li>
                                            <a href="/shop/wishlist">Wish List</a>
                                        </li>
                                        

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget widget_nav_menu">
                                    <h3 class="widget-title">Infomation</h3>
                                    <ul>
                                        <li>
                                            <a href="/pages/about-us">About Us</a>
                                        </li>
                                       
                                       
                                        <li>
                                            <a href="/pages/term-conditions ">Term & Conditions</a>
                                        </li>
                                        <li>
                                            <a href="/pages/privacy-policy ">Privacy Policy</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End footer right-->

                </div>
            </div>
            <div class="tz-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <p>Copyright &copy; 2016 Chopper Parts. All rights reserved.</p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="pull-right">
                            <?php /*?>
                                <span class="payments-method">
                                    <a href="#"><img src="/theme/images/Visa.png" alt="visa"></a>
                                    <a href="#"><img src="/theme/images/Intersection.png" alt="Intersection"></a>
                                    <a href="#"><img src="/theme/images/ebay.png" alt="ebay"></a>
                                    <a href="#"><img src="/theme/images/Amazon.png" alt="Amazon"></a>
                                    <a href="#"><img src="/theme/images/Discover.png" alt="Discover"></a>
                                </span>
                                <?php */ ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--End Footer-->

<script type='text/javascript' src="/theme/js/off-canvas.js"></script>
<!--jQuery Countdow-->
<script src="/theme/js/jquery.plugin.min.js"></script>
<script src="/theme/js/jquery.countdown.min.js"></script>
<!--End Countdow-->

<script src="/theme/js/owl.carousel.js"></script>
<script src="/theme/js/custom.js"></script>
<script>
  ga('send', 'pageview');
</script>
 