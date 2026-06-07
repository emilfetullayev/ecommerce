<footer class="mt-80">
    <div class="container">
        <div class="row">
            <div class="footer-top">
                <div class="col-sm-4">
                    <div class="position-footer-left">
                        <h5 class="toggled title">{{ t('contact_title') }}</h5>
                        <ul class="list-unstyled">
                            <li>
                                <div class="site">
                                    <div class="contact_title">{{ t('address_title') }}:</div>
                                    <div class="contact_site">{{ t('address_desc') }}</div>
                                </div>
                            </li>
                            <li>
                                <div class="phone">
                                    <div class="contact_title">{{ t('phone_title') }}:</div>
                                    <div class="contact_site">+91 123 456 789</div>
                                </div>
                            </li>
                            <li>
                                <div class="email">
                                    <div class="contact_title">email:</div>
                                    <div class="contact_site"><a href="mailto:info@Yourstore.com">demo@Yourstore.com</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="footer-content">
                        <h5>{{ t('contact_title') }}</h5>
                        <ul class="list-unstyled">
{{--                            <li><a href="index8816.html?route=information/information&amp;information_id=4">About Us</a>--}}
{{--                            </li>--}}
                            <li><a href="{{ route('web.contact') }}">{{ t('contact_title') }}</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-sm-2">
                    <div class="footer-content">
                        <h5>{{ t('footer_products') }}</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('web.product') }}">{{ t('all_products') }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="footer-content">
                        <h5>{{ t('my_account') }}</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('cart.index') }}">{{ t('order_history') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="position-footer-bottom">
                <div class="social-media"><a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i
                            class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-youtube-play"></i></a> <a
                        href="#"><i class="fa fa-google-plus"></i></a> <a href="#"> <i
                            class="fa fa-pinterest-p"></i></a></div>
                <div class="payment-link"><img src="image/catalog/payment.png" alt=""></div>
            </div>
            <p class="powered">Powered By <a href="http://www.opencart.com/">OpenCart</a> Your Store &copy; 2026</p>
        </div>
    </div>
</footer>
