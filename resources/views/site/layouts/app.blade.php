<!DOCTYPE html>

<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en">
<!--<![endif]-->

<!-- Mirrored from opencart.mahardhi.com/MT03/tooltrex/01/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 May 2026 14:10:56 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Your Store</title>
    <base/>
    <meta name="description" content="My Store"/>
    <script src="{{ asset('web/javascript/jquery/jquery-2.1.1.min.js') }}"></script>

    <link href="{{ asset('web/javascript/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" media="screen"/>

    <script src="{{ asset('web/javascript/bootstrap/js/bootstrap.min.js') }}"></script>

    <link href="{{ asset('web/javascript/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600&amp;display=swap"
          rel="stylesheet">

    <script src="{{ asset('web/javascript/mahardhi/jquery.elevateZoom.min.js') }}"></script>

    <script src="{{ asset('web/javascript/jquery/magnific/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('web/javascript/mahardhi/owl.carousel.min.js') }}"></script>

    <link href="{{ asset('web/theme/mahardhi/stylesheet/mahardhi/mahardhi-font.css') }}" rel="stylesheet">
    <link href="{{ asset('web/theme/mahardhi/stylesheet/mahardhi/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/theme/mahardhi/stylesheet/mahardhi/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/theme/mahardhi/stylesheet/mahardhi/owl.theme.default.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('web/javascript/jquery/magnific/magnific-popup.css') }}">

    <script type="text/javascript" src="{{ asset('web/javascript/mahardhi/slick.js') }}"></script>

    <link href="{{ asset('web/theme/mahardhi/stylesheet/mahardhi/slick.css') }}" rel="stylesheet">

    <script src="{{ asset('web/javascript/mahardhi/mahardhi_search.js') }}"></script>
    <style>
        :root {
            --primary-color: #151515;
            --primary-hover-color: #ffc10a;
            --secondary-color: #ffffff;
            --secondary-light-color: #777777;
            --background-color: #f7f7f7;
            --border-color: #e2e2e2
        }
    </style>
    <link href="{{ asset('web/theme/mahardhi/stylesheet/stylesheet.css') }}" rel="stylesheet">
    <link href="{{ asset('web/javascript/jquery/swiper/css/swiper.min.css') }}" type="text/css" rel="stylesheet"
          media="screen"/>
    <link href="{{ asset('web/javascript/jquery/swiper/css/opencart.css') }}" type="text/css" rel="stylesheet"
          media="screen"/>
    <script src="{{ asset('web/javascript/jquery/swiper/js/swiper.jquery.js') }}"></script>
    <script src="{{ asset('web/javascript/mahardhi/tabs.js') }}"></script>
    <script src="{{ asset('web/javascript/mahardhi/countdown.js') }}"></script>
    <script src="{{ asset('web/javascript/mahardhi/jquery.cookie.js') }}"></script>
    <script src="{{ asset('web/javascript/common.js') }}"></script>
    <script src="{{ asset('web/javascript/mahardhi/jquery-ui.min.js') }}"></script>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('web/theme/mahardhi/stylesheet/mahardhi/jquery-ui.min.css') }}">
    <script src="{{ asset('web/javascript/mahardhi/custom.js') }}"></script>
    <link href="image/catalog/cart.png" rel="icon"/>
</head>
<body class="common-home">

<style>
    /* Slayderin ümumi konteyneri və izolasiyası */
    .slideshow {
        position: relative !important;
        width: 100% !important;
        margin-bottom: 50px !important; /* Aşağıdakı modullarla olan məsafə */
    }

    .slideshow .swiper-container {
        width: 100% !important;
        height: 530px !important; /* Dizayndakı hündürlük */
        background-color: #f5f5f5 !important; /* Şəkildəki orijinal açıq boz fon */
    }

    .slideshow .swiper-slide {
        width: 100% !important;
        height: 100% !important;
        background-color: #f5f5f5 !important;
    }

    /* İçindəki elementləri yan-yana düzən əsas blok */
    .main-slide-container {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        width: 100% !important;
        height: 100% !important;
        padding: 0 10% 0 8% !important; /* Sol və sağdan ideal boşluqlar */
        box-sizing: border-box !important;
    }

    /* Sol Tərəf - PNG Şəkil sahəsi */
    .slideshow .slide-image-side {
        flex: 1 !important;
        display: flex !important;
        justify-content: center !important; /* Şəkli üfüqi mərkəzləyir */
        align-items: center !important; /* Şəkli şaquli mərkəzləyir */
        height: 100% !important;
        max-width: 50% !important;
    }

    /* PNG şəklin özü */
    .slideshow .slide-image-side img {
        max-height: 80% !important; /* Slayderin içindən daşmaması üçün */
        max-width: 100% !important;
        object-fit: contain !important; /* Şəklin nisbətini pozmur */
        display: block !important;
    }

    /* Sağ Tərəf - Mətn və Düymə sahəsi */
    .slideshow .slide-content-side {
        flex: 1 !important;
        max-width: 45% !important;
        text-align: left !important;
        padding-left: 40px !important;
    }

    /* Dizayndakı kiçik üst yazı (Up to 40% Discounts) */
    .slideshow .slide-content-side .sub-title {
        display: block !important;
        font-size: 20px !important;
        font-weight: 500 !important;
        color: #333333 !important;
        margin-bottom: 12px !important;
        font-family: 'Work Sans', sans-serif !important;
        letter-spacing: 0.3px !important;
    }

    /* Dizayndakı iri və qalın başlıq (Best Hand Tools...) */
    .slideshow .slide-content-side .main-title {
        display: block !important;
        font-size: 50px !important;
        font-weight: 700 !important;
        color: #111111 !important;
        line-height: 1.15 !important;
        margin-top: 0 !important;
        margin-bottom: 15px !important;
        font-family: 'Work Sans', sans-serif !important;
    }

    /* Qiymət yazısı (Əgər HTML-də saxlasanız) */
    .slideshow .slide-content-side .slide-price {
        font-size: 24px !important;
        font-weight: 600 !important;
        color: #111111 !important;
        margin-bottom: 25px !important;
        font-family: 'Work Sans', sans-serif !important;
    }

    /* Tam dizayndakı sarı "SHOP NOW" düyməsi */
    .slideshow .slide-content-side .btn-shop-now {
        display: inline-block !important;
        background-color: #ffc10a !important; /* Orijinal sarı rəng */
        color: #111111 !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        padding: 14px 35px !important;
        letter-spacing: 1px !important;
        text-decoration: none !important;
        border: none !important;
        transition: all 0.3s ease !important;
        cursor: pointer !important;
    }

    /* Düymənin üzərinə gəldikdə qara olması */
    .slideshow .slide-content-side .btn-shop-now:hover {
        background-color: #111111 !important;
        color: #ffffff !important;
    }

    /* Oxların (Arrows) şəklin üzərinə tam oturması üçün vizual düzəliş */
    .slideshow .swiper-pager .swiper-button-prev,
    .slideshow .swiper-pager .swiper-button-next {
        z-index: 30 !important;
    }

    /* Mobil və Planşet Ekranlar üçün Tam Uyum (Responsive) */
    @media (max-width: 991px) {
        .slideshow .swiper-container {
            height: 420px !important;
        }

        .slideshow .slide-content-side .main-title {
            font-size: 34px !important;
        }
    }

    @media (max-width: 767px) {
        .slideshow .swiper-container {
            height: auto !important;
        }

        .main-slide-container {
            flex-direction: column !important; /* Mobildə şəkil yuxarıda, yazı aşağıda olur */
            padding: 30px 20px !important;
        }

        .slideshow .slide-image-side {
            max-width: 100% !important;
            height: 230px !important;
            margin-bottom: 20px !important;
        }

        .slideshow .slide-content-side {
            max-width: 100% !important;
            text-align: center !important;
            padding-left: 0 !important;
        }

        .slideshow .slide-content-side .main-title {
            font-size: 28px !important;
        }
    }
</style>

<style>

    :root {

        --primary-color: #151515;

        --primary-hover-color: #ffc10a;

        --secondary-color: #ffffff;

        --secondary-light-color: #777777;

        --background-color: #f7f7f7;

        --border-color: #e2e2e2

    }



    /* Ümumi Kart Strukturu */
    .custom-product-card {
        background: #fff;
        border: 1px solid #f0f0f0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.03);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%; /* Bütün kartların hündürlüyünü bərabərləşdirir */
    }

    .custom-product-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: #e5e5e5;
    }

    /* Şəkil Bölməsi - Hündürlüyü Standartlaşdırmaq üçün Ən Əsas Hissə */
    .product-img-wrapper {
        position: relative;
        height: 200px; /* İstədiyin hündürlüyü bura yaza bilərsən */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 15px;
        background-color: #f9f9f9; /* Şəkil arxası boşluqlar üçün yüngül fon */
        border-radius: 6px;
    }

    .product-img-wrapper img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain; /* Şəkli deformasiya etmədən çərçivəyə sığdırır */
        transition: opacity 0.3s ease;
    }

    /* Hover-da şəkil dəyişmə effekti (əgər varsa) */
    .product-img-wrapper .hover-img {
        position: absolute;
        opacity: 0;
    }
    .custom-product-card:hover .hover-img {
        opacity: 1;
    }

    /* İnformasiya Bölməsi */
    .product-info-wrapper {
        padding-top: 10px;
    }

    .product-title {
        font-size: 14px;
        font-weight: 500;
        margin: 0 0 10px 0;
        height: 40px; /* Başlıq 2 sətirlik yer tutsun deyə (düzülüş pozulmasın) */
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.2s;
    }

    .product-title a:hover {
        color: #ffbc00; /* Brend rənginiz */
    }

    /* Qiymət Bölməsinin Yeni Estetik Görünüşü */
    .pro-price {
        margin-top: 5px;
    }

    .price-new {
        background-color: #ffbc00; /* Şəkildəki sarı rəng */
        color: #000;
        font-weight: 700;
        font-size: 16px;
        padding: 6px 15px;
        border-radius: 20px;
        display: inline-block;
    }

    /* Səbətə At Düyməsi (Şəklin üstünə gələndə altdan çıxan effekt) */
    .pro-addcart {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        text-align: center;
        transition: all 0.3s ease;
        opacity: 0;
    }

    .product-img-wrapper:hover .pro-addcart {
        bottom: 10px;
        opacity: 1;
    }

    .addcart {
        background: #333;
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }

    .addcart:hover {
        background: #ffbc00;
        color: #000;
    }

</style>


@include('site.partials.navbar')

@include('site.partials.header')


<script>
    $(document).ready(function () {
        var headerfixed = 0;
        if (headerfixed == 1) {
            $(window).scroll(function () {
                if ($(window).width() > 991) {
                    if ($(this).scrollTop() > 160) {
                        $('header').addClass('header-fixed');
                    } else {
                        $('header').removeClass('header-fixed');
                    }
                } else {
                    $('header').removeClass('header-fixed');
                }
            });
        } else {
            $('header').removeClass('header-fixed');
        }
    });
</script>

@yield('content')


<script>
    document.addEventListener("DOMContentLoaded", function () {

        // ==========================================================================
        // 1. MİQDAR ARTIRMA VƏ AZALTMA FUNKSİYASI (PLUS / MINUS)
        // ==========================================================================
        document.addEventListener('click', function (e) {

            // --- PLUS (+) DÜYMƏSİNƏ KLİKLƏNİB? ---
            var btnPlus = e.target.closest('.detal-qty-plus, .grainger-qty-plus');
            if (btnPlus) {
                e.preventDefault();

                let input = btnPlus.classList.contains('detal-qty-plus')
                    ? document.getElementById('input-quantity') // Detal səhifəsi üçün
                    : btnPlus.parentElement.querySelector('.grainger-qty-input'); // Siyahı üçün

                if (input) {
                    input.value = (parseInt(input.value) || 1) + 1;
                }
            }

            // --- MINUS (-) DÜYMƏSİNƏ KLİKLƏNİB? ---
            var btnMinus = e.target.closest('.detal-qty-minus, .grainger-qty-minus');
            if (btnMinus) {
                e.preventDefault();

                let input = btnMinus.classList.contains('detal-qty-minus')
                    ? document.getElementById('input-quantity') // Detal səhifəsi üçün
                    : btnMinus.parentElement.querySelector('.grainger-qty-input'); // Siyahı üçün

                if (input) {
                    let v = parseInt(input.value) || 1;
                    if (v > 1) {
                        input.value = v - 1;
                    }
                }
            }
        });


        // ==========================================================================
        // 2. SƏBƏTƏ ƏLAVƏ ET FUNKSİYASI (UNIVERSAL FETCH / AJAX)
        // ==========================================================================
        document.addEventListener('click', function (e) {

            // Kliklənən element real səbət düyməsidirsə (Köhnə ID və ya Yeni Class)
            var btnCart = e.target.closest('#button-cart, .grainger-btn-cart');

            if (btnCart) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var productId = null;
                var quantity = 1;

                // A variantı: DETAL SƏHİFƏSİ (ID əsaslı mexanizm)
                if (btnCart.id === 'button-cart') {
                    productId = document.getElementById('main-product-id')?.value;
                    let qtyInput = document.getElementById('input-quantity');
                    quantity = qtyInput ? (parseInt(qtyInput.value) || 1) : 1;
                }
                // B variantı: SİYAHI BLOKU (Class əsaslı mexanizm)
                else if (btnCart.classList.contains('grainger-btn-cart')) {
                    var productCard = btnCart.closest('.grainger-product-card');
                    productId = productCard ? productCard.getAttribute('data-product-id') : null;
                    let qtyInput = productCard ? productCard.querySelector('.grainger-qty-input') : null;
                    quantity = qtyInput ? (parseInt(qtyInput.value) || 1) : 1;
                }

                // ID tapılmadıqda xəta ver və dayandır
                if (!productId) {
                    alert('Məhsul ID tapılmadı!');
                    return;
                }

                // Düyməni loading vəziyyətinə gətir
                var originalText = btnCart.innerHTML;
                btnCart.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Yüklənir...';
                btnCart.disabled = true;

                // Təhlükəsiz Fetch (AJAX) Sorğusu
                fetch('/cart/add', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        // Düyməni normal halına qaytar
                        btnCart.innerHTML = originalText;
                        btnCart.disabled = false;

                        if (data.success) {
                            alert(data.success);

                            // ==========================================================================
                            // HEADER REFRESH (Səbət Sayğacları)
                            // ==========================================================================

                            // Səbətdəki ümumi sayı yeniləyir
                            document.querySelectorAll('.cart-item').forEach(el => {
                                el.innerText = data.cart_count;
                            });

                            // Səbət məbləğ blokunu yeniləyir
                            var cartTotal = document.getElementById('cart-total');
                            if (cartTotal) {
                                cartTotal.innerHTML = `
                                <span class="hidden-sm hidden-xs">My Cart:</span>
                                <span class="cart-item">${data.cart_count}</span>
                                <span class="hidden-sm hidden-xs"> - $${data.cart_total ?? '0.00'}</span>
                            `;
                            }
                        } else {
                            alert(data.error || 'Xəta baş verdi');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        btnCart.innerHTML = originalText;
                        btnCart.disabled = false;
                        alert('Sistem xətası baş verdi!');
                    });
            }
        }, true);

    });
</script><script>
    $(document).ready(function() {
        $('#related-carousel').owlCarousel({
            loop: false,
            nav: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            dots: false,
            items: 5,
            responsive: {
                0: {items: 1},
                480: {items: 2},
                768: {items: 3},
                992: {items: 4},
                1200: {items: 5}
            }
        });
    });
</script>
<script>
    $('select[name=\'recurring_id\'], input[name="quantity"]').change(function () {
        $.ajax({
            url: 'index.php?route=product/product/getRecurringDescription',
            type: 'post',
            data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
            dataType: 'json',
            beforeSend: function () {
                $('#recurring-description').html('');
            },
            success: function (json) {
                $('.alert-dismissible, .text-danger').remove();

                if (json['success']) {
                    $('#recurring-description').html(json['success']);
                }
            }
        });
    });
    //--></script>
<script>
    $('#button-cart').on('click', function () {
        $.ajax({
            url: 'index.php?route=checkout/cart/add',
            type: 'post',
            data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
            dataType: 'json',
            beforeSend: function () {
                $('#button-cart').button('loading');
            },
            complete: function () {
                $('#button-cart').button('reset');
            },
            success: function (json) {
                $('.alert-dismissible, .text-danger').remove();
                $('.form-group').removeClass('has-error');

                if (json['error']) {
                    if (json['error']['option']) {
                        for (i in json['error']['option']) {
                            var element = $('#input-option' + i.replace('_', '-'));

                            if (element.parent().hasClass('input-group')) {
                                element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            } else {
                                element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            }
                        }
                    }

                    if (json['error']['recurring']) {
                        $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                    }

                    // Highlight any found errors
                    $('.text-danger').parent().addClass('has-error');
                }

                if (json['success']) {
                    $('#content').parent().before('<div class="alert alert-success alert-dismissible">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#cart > button').html('<span id="cart-total">' + json['total'] + '</span>');

                    $('html, body').animate({scrollTop: 0}, 'slow');

                    $('#cart > ul').load('index1e1c.html?route=common/cart/info%20ul%20li');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    //--></script>
<script>
    $('.date').datetimepicker({
        language: 'en-gb',
        pickTime: false
    });

    $('.datetime').datetimepicker({
        language: 'en-gb',
        pickDate: true,
        pickTime: true
    });

    $('.time').datetimepicker({
        language: 'en-gb',
        pickDate: false
    });

    $('button[id^=\'button-upload\']').on('click', function () {
        var node = this;

        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function () {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: 'index.php?route=tool/upload',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $(node).button('loading');
                    },
                    complete: function () {
                        $(node).button('reset');
                    },
                    success: function (json) {
                        $('.text-danger').remove();

                        if (json['error']) {
                            $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                        }

                        if (json['success']) {
                            alert(json['success']);

                            $(node).parent().find('input').val(json['code']);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });
    //--></script>
<script>
    $('#review').delegate('.pagination a', 'click', function (e) {
        e.preventDefault();

        $('#review').fadeOut('slow');

        $('#review').load(this.href);

        $('#review').fadeIn('slow');
    });

    $('#review').load('index43b9.html?route=product/product/review&amp;product_id=28');

    $('#button-review').on('click', function () {
        $.ajax({
            url: 'index.php?route=product/product/write&product_id=28',
            type: 'post',
            dataType: 'json',
            data: $("#form-review").serialize(),
            beforeSend: function () {
                $('#button-review').button('loading');
            },
            complete: function () {
                $('#button-review').button('reset');
            },
            success: function (json) {
                $('.alert-dismissible').remove();

                if (json['error']) {
                    $('#review').after('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

                if (json['success']) {
                    $('#review').after('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').prop('checked', false);
                }
            }
        });
    });
    //--></script>

<!-- M-Custom script -->
<script>

    // Additional images
    const direction = $('html').attr('dir');

    $('#additional-carousel').each(function () {
        if ($(this).closest('#column-left').length == 0 && $(this).closest('#column-right').length == 0) {
            $(this).addClass('owl-carousel owl-theme');
            const items = $(this).data('items') || 4;
            const sliderOptions = {
                loop: false,
                nav: true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                dots: false,
                items: items,
                mouseDrag: false,
                touchDrag: false,
                pullDrag: false,
                rewind: false,
                autoplay: true,
                responsiveRefreshRate: 200,
                responsive: {
                    0: {items: 1},
                    300: {items: ((items - 2) > 1) ? (items - 2) : 1},
                    320: {items: ((items - 1) > 1) ? (items - 1) : 1},
                    426: {items: items},
                    768: {items: ((items - 1) > 1) ? (items - 1) : 1},
                    992: {items: items}
                }
            };
            if (direction == 'rtl') sliderOptions['rtl'] = true;
            $(this).owlCarousel(sliderOptions);
        }
    });

    $(document).ready(function () {
        if ($(window).width() > 991) {
            $("#zoom").elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                gallery: 'additional-carousel',
                galleryActiveClass: 'active'
            });

            var image_index = 0;
            $(document).on('click', '.thumbnail', function () {
                $('.thumbnails').magnificPopup('open', image_index);
                return false;
            });

            $('#additional-carousel a').click(function () {
                var smallImage = $(this).attr('data-image');
                var largeImage = $(this).attr('data-zoom-image');
                var ez = $('#zoom').data('elevateZoom');
                $('.thumbnail').attr('href', largeImage);
                ez.swaptheimage(smallImage, largeImage);
                image_index = $(this).index('#additional-carousel a');
                return false;
            });
        } else {
            $(document).on('click', '.thumbnail', function () {
                $('.thumbnails').magnificPopup('open', 0);
                return false;
            });
        }
    });

    $(document).ready(function () {
        $('.thumbnails').magnificPopup({
            type: 'image',
            delegate: 'a.elevatezoom-gallery', // Mahardhi Edit
            gallery: {
                enabled: true
            }
        });
    });

    //--></script>

@include('site.partials.footer')

<!-- top scroll -->
<a href="#" class="scrollToTop back-to-top" data-toggle="tooltip" title="Top"><i class="fa fa-angle-up"></i></a>
</body>

<!-- Mirrored from opencart.mahardhi.com/MT03/tooltrex/01/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 May 2026 14:11:41 GMT -->
</html>
