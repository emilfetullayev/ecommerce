
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .product-link {
        display: block;
            width: 100%;
    }
</style>

<footer class="mt-80">
    <div class="container">
        <div class="row">
            <div class="footer-top">
                <div class="col-sm-4">
                    <div class="position-footer-left">
                        <h5 class="toggled title">{{ t('contact_title') }}</h5>
                        <ul class="list-unstyled">

                            <li>
                                <div class="phone">
                                    <div class="contact_title">{{ t('phone_title') }}:</div>
                                    <div class="contact_site">050 860 88 85</div>
                                </div>
                            </li>
                            <li>
                                <div class="email">
                                    <div class="contact_title">email:</div>
                                    <div class="contact_site"><a href="mailto:canpowertoolsaz@gmail.com">canpowertoolsaz@gmail.com</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="col-sm-2">
                    <div class="footer-content">
                        <a href="{{ route('web.product') }}" class="product-link"><h5>{{ t('all_products') }}</h5></a>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="footer-content">
                        <a href="{{ route('cart.index') }}" class="product-link"><h5>{{ t('order_history') }}</h5></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="position-footer-bottom">
                <div class="social-media">
                    <a href="https://www.instagram.com/can_construction_tools?utm_source=qr&igsh=YWloaDJpb21naWYy" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://www.tiktok.com/@can_power_tools?_r=1&_t=ZS-97Egh7fPvy1" target="_blank">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                </div>
                <div class="payment-link"><img src="image/catalog/payment.png" alt=""></div>
            </div>
            <p class="powered">
                {{ t('copyright') }} &copy; 2026
            </p>
        </div>
    </div>
</footer>
