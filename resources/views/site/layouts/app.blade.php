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

    /* Səbət Paneli Əsas Struktur */
    .cart-sidebar {
        position: fixed;
        top: 0;
        right: -400px; /* Defolt olaraq gizli */
        width: 380px;
        height: 100%;
        background-color: #fff;
        box-shadow: -5px 0 15px rgba(0,0,0,0.1);
        z-index: 9999;
        transition: right 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        font-family: sans-serif;
    }

    .cart-sidebar.open {
        right: 0; /* Aktiv olduqda görünür */
    }

    /* Arxa fon qaraltısı */
    .cart-sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9998;
        display: none;
    }

    .cart-sidebar-overlay.open {
        display: block;
    }

    /* Header */
    .cart-sidebar-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .cart-sidebar-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
    }
    .close-sidebar-btn {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
    }

    /* Body və Məhsul Siyahısı */
    .cart-sidebar-body {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
    }

    .cart-sidebar-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #f9f9f9;
        padding-bottom: 15px;
    }
    .cart-item-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border: 1px solid #eee;
        margin-right: 15px;
    }
    .cart-item-details {
        flex: 1;
    }
    .cart-item-name {
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 5px 0;
    }
    .cart-item-price {
        color: #27ae60;
        font-weight: bold;
        margin-bottom: 8px;
    }

    /* Say idarəetmə paneldə */
    .sidebar-qty-group {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        width: fit-content;
    }
    .sidebar-qty-btn {
        background: #f5f5f5;
        border: none;
        padding: 2px 8px;
        cursor: pointer;
    }
    .sidebar-qty-input {
        width: 35px;
        text-align: center;
        border: none;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        font-size: 12px;
    }
    .btn-remove-item {
        background: none;
        border: none;
        color: #999;
        margin-left: 10px;
        cursor: pointer;
        font-size: 16px;
    }
    .btn-remove-item:hover { color: #cc0000; }

    /* Cəmi və Çatdırılma */
    .cart-sidebar-summary {
        margin-top: 20px;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        font-size: 16px;
    }
    .total-price { color: #27ae60; }
    .shipping-info {
        margin-top: 10px;
        font-size: 13px;
        color: #666;
    }

    /* Footer Düymələr */
    .cart-sidebar-footer {
        padding: 20px;
        border-top: 1px solid #eee;
    }
    .btn-sidebar-checkout {
        display: block;
        width: 100%;
        background: #111;
        color: #fff;
        text-align: center;
        padding: 12px;
        font-weight: bold;
        text-decoration: none;
        margin-bottom: 10px;
    }
    .btn-sidebar-view-cart {
        display: block;
        width: 100%;
        background: #fff;
        color: #111;
        border: 1px solid #111;
        text-align: center;
        padding: 12px;
        font-weight: bold;
        text-decoration: none;
        margin-bottom: 10px;
    }
    .btn-sidebar-checkout:hover { background: #333; color: #fff; }
    .btn-sidebar-view-cart:hover { background: #f5f5f5; color: #111; }
    .secure-shopping {
        text-align: center;
        font-size: 12px;
        color: #27ae60;
    }

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


<style>
    /* ==========================================================================
Grainger Style Product Card - TAM VƏ YEKUN RESPONSIVE CSS KODU
========================================================================== */

    /* Saytın arxa fonunu tam ağ yox, yüngül boz edirik ki, ağ kartlar özünü göstərsin */
    body {
        background-color: #f5f7fa !important;
    }

    /* Ana Bölüm Başlığı */
    .grainger-main-heading {
        font-size: 24px !important;
        font-weight: bold !important;
        color: #000 !important;
        margin-bottom: 25px !important;
        text-transform: none !important;
    }

    /* Bootstrap Grid üçün Flex Row Tənzimləməsi */
    .display-flex-row {
        display: flex !important;
        flex-wrap: wrap !important;
        margin-right: -10px !important;
        margin-left: -10px !important;
    }

    /* Sütunlar daxilində kartların tam hündürlük alması üçün */
    .product-layout {
        padding-right: 10px !important;
        padding-left: 10px !important;
        margin-bottom: 20px !important;
        display: flex !important;
    }

    /* Əsas Məhsul Kartı Konteyneri */
    .grainger-product-card {
        display: flex !important;
        flex-direction: row !important;
        background: #fff !important;
        border: 1px solid #e5e5e5 !important;
        border-radius: 12px !important;
        padding: 20px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        position: relative !important;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
    }

    /* Kartın Hover Effekti */
    .grainger-product-card:hover {
        transform: translateY(-4px) !important;
        border-color: #ffc10a !important;
        box-shadow: 0 6px 20px rgba(255, 193, 10, 0.15) !important;
    }

    /* Sol Tərəf: Şəkil Bölməsi */
    .grainger-img-wrapper {
        width: 30% !important;
        max-width: 120px !important;
        display: flex !important;
        align-items: flex-start !important;
        justify-content: center !important;
        margin-right: 15px !important;
    }

    .grainger-img-wrapper img {
        max-width: 100% !important;
        height: auto !important;
        object-fit: contain !important;
    }

    /* Sağ Tərəf: Məlumat Bloklarının Ana Bölməsi */
    .grainger-info-wrapper {
        width: 70% !important;
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }

    /* Üst Hissə Elementləri */
    .grainger-top-meta {
        margin-bottom: 8px !important;
    }

    .grainger-brand {
        font-size: 13px !important;
        font-weight: 700 !important;
        color: #222 !important;
        text-transform: uppercase !important;
        margin-bottom: 5px !important;
        display: block !important;
    }

    .grainger-title {
        margin: 0 0 6px 0 !important;
        font-size: 18px !important;
        line-height: 1.4 !important;
    }

    .grainger-title a {
        color: #0056b3 !important;
        text-decoration: none !important;
        font-weight: 600 !important;
    }

    .grainger-title a:hover {
        text-decoration: underline !important;
    }

    .grainger-sku {
        font-size: 13px !important;
        color: #666 !important;
    }

    /* Sarı Ulduzlar */
    .grainger-rating {
        margin-top: 6px !important;
        font-size: 13px !important;
        display: flex !important;
        align-items: center !important;
        gap: 2px !important;
    }

    .text-warning {
        color: #ffc107 !important;
    }

    .rating-count {
        color: #666 !important;
        font-size: 12px !important;
        margin-left: 5px !important;
        font-weight: normal !important;
    }

    /* Orta Hissə: Qiymət Bloku */
    .grainger-price-block {
        margin-bottom: 5px !important;
        margin-top: -6px !important;
    }

    .grainger-price-block .price-label {
        display: block !important;
        font-size: 13px !important;
        color: #555 !important;
        margin-bottom: 3px !important;
    }

    .price-row {
        display: flex !important;
        align-items: baseline !important;
        gap: 6px !important;
    }

    /* Üstü Xəttli Köhnə Qiymət Tənzimləməsi */
    .price-old {
        font-size: 15px !important;
        color: #999 !important;
        text-decoration: line-through !important;
        margin-right: 8px !important;
        font-weight: normal !important;
    }

    /* Canlı yeni qiymət */
    .grainger-price-block .price-amount {
        font-size: 22px !important;
        font-weight: 700 !important;
        color: #007a3d !important;
        margin-top: 6px;

    }

    .grainger-price-block .price-unit {
        font-size: 13px !important;
        color: #666 !important;
    }

    /* Alt Hissə: Düymələr Sətri */
    .grainger-action-block {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 12px !important;
        width: 100% !important;
        margin-top: auto !important;
    }

    /* Miqdar (Adet) Bölməsi */
    .quantity-wrapper {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        flex-shrink: 0 !important;
    }

    /* "Adet" Mətni */
    .quantity-wrapper .qty-label {
        font-size: 15px !important;
        color: #222 !important;
        font-weight: bold !important;
        margin-right: 12px !important;
        white-space: nowrap !important;
    }

    /* PLUS/MINUS QRUPU (Ətrafındakı böyük border silinib) */
    .qty-control-group {
        display: flex !important;
        align-items: center !important;
        background: transparent !important;
        border: none !important;
        height: 36px !important;
    }

    /* İncə, təmiz Plus və Minus işarələri */
    .qty-btn {
        width: 28px !important;
        height: 36px !important;
        background: transparent !important;
        border: none !important;
        color: #444 !important;
        font-size: 20px !important;
        font-weight: bold !important;
        cursor: pointer !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: color 0.2s !important;
    }

    .qty-btn:hover {
        color: #000 !important;
        background: transparent !important;
    }

    /* Ortadakı rəqəm sahəsi */
    .qty-input {
        width: 35px !important;
        height: 36px !important;
        text-align: center !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 6px !important;
        font-size: 18px !important;
        font-weight: bold !important;
        color: #000 !important;
        background: transparent !important;
        box-shadow: none !important;
        outline: none !important;
        -moz-appearance: textfield !important;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none !important;
        margin: 0 !important;
    }

    /* SEPETE EKLE BUTONU */
    .btn-cart {
        flex: 1 !important;
        height: 40px !important;
        background-color: #ffc10a !important;
        color: #000000 !important;
        border: 1px solid #ffc10a !important;
        border-radius: 8px !important;
        font-weight: bold !important;
        font-size: 15px !important;
        cursor: pointer !important;
        white-space: nowrap !important;
        padding: 0 15px !important;
        line-height: 38px !important;
        transition: all 0.25s ease-in-out !important;
    }

    .btn-login {
        flex: 1 !important;
        height: 40px !important;
        background-color: #ffc10a !important;
        color: #000000 !important;
        border: 1px solid #ffc10a !important;
        border-radius: 8px !important;
        font-weight: bold !important;
        font-size: 15px !important;
        cursor: pointer !important;
        white-space: nowrap !important;
        padding: 0 15px !important;
        line-height: 38px !important;
        transition: all 0.25s ease-in-out !important;
    }


    .btn-cart:hover {
        background-color: #000000 !important;
        border-color: #000000 !important;
        color: #ffffff !important;
    }

    /* ==========================================================================
       MEDIA QUERIES (PLANŞET VƏ MOBİL RESPONSIVE SƏVİYYƏSİ)
       ========================================================================== */

    /* Planşetlər və kiçik ekranlı noutbuklar üçün (max-width: 991px) */
    @media (max-width: 991px) {
        .grainger-title {
            font-size: 16px !important;
        }

        .grainger-price-block .price-amount {
            font-size: 20px !important;
        }
    }

    /* Mobil telefonlar üçün Tam Mərkəzləşdirilmiş Grid Quruluşu (max-width: 767px) */
    @media (max-width: 767px) {
        /* Kartı alt-alta sıralayıb mərkəzə çəkirik */
        .grainger-product-card {
            flex-direction: column !important;
            padding: 15px !important;
            align-items: center !important;
        }

        /* Şəkli yuxarı-orta hissədə tam balanslaşdırırıq */
        .grainger-img-wrapper {
            width: 100% !important;
            max-width: 140px !important;
            margin-right: 0 !important;
            margin-bottom: 15px !important;
            display: flex !important;
            justify-content: center !important;
        }

        /* Məlumatları sola bərabərləyib tam en edirik */
        .grainger-info-wrapper {
            width: 100% !important;
            text-align: left !important;
        }

        .grainger-title {
            font-size: 16px !important;
            line-height: 1.4 !important;
            margin-bottom: 5px !important;
        }

        .grainger-price-block {
            margin-bottom: -12px !important;
        }

        .grainger-price-block .price-amount {
            font-size: 20px !important;
        }

        /* Alt qrup: Düymələri səliqəli şəkildə yan-yana yerləşdiririk */
        .grainger-action-block {
            flex-direction: row !important;
            justify-content: space-between !important;
            width: 100% !important;
            gap: 10px !important;
            border-top: 1px solid #f0f0f0 !important; /* Alt paneli ayıran incə zərif xətt */
            padding-top: 12px !important;
            margin-top: 10px !important;
        }

        .quantity-wrapper {
            flex: 0 0 auto !important;
        }

        .quantity-wrapper .qty-label {
            font-size: 14px !important;
            margin-right: 6px !important;
        }

        /* Mobildə klikləmə rahat olsun deyə kəmiyyət seçiminə yüngül border veririk */
        .qty-control-group {
            height: 38px !important;
            border: 1px solid #ddd !important;
            border-radius: 6px !important;
            padding: 0 4px !important;
        }

        .qty-btn {
            width: 26px !important;
            height: 38px !important;
            font-size: 18px !important;
        }

        .qty-input {
            width: 30px !important;
            font-size: 16px !important;
        }

        .btn-cart {
            flex: 1 !important;
            height: 40px !important;
            line-height: 38px !important;
            font-size: 14px !important;
            text-align: center !important;
            border-radius: 6px !important;
        }
    }

    @media (max-width: 360px) {
        .grainger-action-block {
            flex-direction: column !important;
            align-items: stretch !important;
        }

        .quantity-wrapper {
            justify-content: space-between !important;
            margin-bottom: 8px !important;
        }
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

<style>
    .grainger-product-card.style-ad-card {
        display: flex !important;
        flex-direction: column !important;
        background: #fff !important;
        border: 1px solid #eef0f2 !important;
        border-radius: 12px !important;
        padding: 12px !important;
        margin-bottom: 20px !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02) !important;
    }

    .ad-image-box {
        width: 100% !important;
        height: 170px !important;
        position: relative !important;
        overflow: hidden !important;
        border-radius: 10px !important;
        background-color: #ffffff !important;
        margin-bottom: 12px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .ad-image-box a {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        height: 100% !important;
    }

    .ad-image-box img {
        max-width: 100% !important;
        max-height: 100% !important;
        width: auto !important;
        height: auto !important;
        object-fit: contain !important;
    }





    /* Yazı bloku tam genişliyə yayılır və sağdakı boşluğu doldurur */
    .grainger-info-wrapper {
        display: flex !important;
        flex-direction: column !important;
        gap: 6px !important;
        width: 100% !important; /* Mətnlərin sağa doğru yayılmasını təmin edir */
    }

    .grainger-top-meta {
        width: 100% !important;
    }

    /* Başlığın tək sətirdə sıxılıb qalmaması və sağa uzanması üçün */
    .grainger-title {
        font-size: 14px !important;
        font-weight: 600 !important;
        margin: 5px 0 !important;
        width: 100% !important;
        display: block !important;
    }

    .grainger-title a {
        display: block !important;
        width: 100% !important;
        white-space: normal !important; /* Yazı çox uzun olduqda alt sətirə keçə bilsin */
    }
</style>


<div id="right-cart-sidebar" class="cart-sidebar">
    <div class="cart-sidebar-header">
        <h3>Səbətiniz (<span class="sidebar-cart-count">0</span>)</h3>
        <button type="button" id="close-cart-sidebar" class="close-sidebar-btn">&times;</button>
    </div>

    <div class="cart-sidebar-body">
        <div id="sidebar-cart-empty" style="display: none; text-align: center; padding: 20px;">
            Səbətiniz boşdur.
        </div>

        <div id="sidebar-cart-items">
        </div>

        <div class="cart-sidebar-summary">
            <div class="summary-row">
                <span>Cəmi:</span>
                <span id="sidebar-cart-total" class="total-price">0.00 AZN</span>
            </div>
        </div>
    </div>

    <div class="cart-sidebar-footer">
        <a href="/cart" class="btn-sidebar-checkout">SİFARİŞƏ KEÇ</a>
        <div class="secure-shopping">
            <i class="fa fa-shield"></i> Təhlükəsiz alış-veriş
        </div>
    </div>
</div>

<div id="cart-sidebar-overlay" class="cart-sidebar-overlay"></div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        // Səbət Modalı və Arxa fon elementləri
        const sidebar = document.getElementById('right-cart-sidebar');
        const overlay = document.getElementById('cart-sidebar-overlay');
        const closeBtn = document.getElementById('close-cart-sidebar');

        // Paneli bağlamaq funksiyası
        function closeCartSidebar() {
            if (sidebar) sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('open');
        }

        if (closeBtn) closeBtn.addEventListener('click', closeCartSidebar);
        if (overlay) overlay.addEventListener('click', closeCartSidebar);


        // ==========================================================================
        // 1. MİQDAR ARTIRMA VƏ AZALTMA FUNKSİYASI (+ / -)
        // ==========================================================================


        // ==========================================================================
        // 2. SƏBƏTƏ ƏLAVƏ ET VƏ SAĞ PANELİ (MODAL) DOLDURMA MECHANIZMI
        // ==========================================================================
        document.addEventListener('click', function (e) {

            var btnCart = e.target.closest('#button-cart, .grainger-btn-cart');

            if (btnCart) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var productId = null;
                var quantity = 1;

                // Əsas məhsul kartını tapırıq
                var productCard = btnCart.closest('.grainger-product-card');

                // A variantı: Detal səhifəsindədirsə
                if (btnCart.id === 'button-cart') {
                    productId = document.getElementById('main-product-id')?.value;
                    let qtyInput = document.getElementById('input-quantity');
                    quantity = qtyInput ? (parseInt(qtyInput.value) || 1) : 1;
                }
                // B variantı: Siyahı (Endirimli məhsullar) blokundadırsa
                else if (btnCart.classList.contains('grainger-btn-cart')) {
                    productId = productCard ? productCard.getAttribute('data-product-id') : null;
                    let qtyInput = productCard ? productCard.querySelector('.grainger-qty-input') : null;
                    quantity = qtyInput ? (parseInt(qtyInput.value) || 1) : 1;
                }

                // ID yoxdursa dayandır
                if (!productId) {
                    alert('Məhsul ID tapılmadı!');
                    return;
                }

                // Düyməni yüklənir vəziyyətinə gətir
                var originalText = btnCart.innerHTML;
                btnCart.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
                btnCart.disabled = true;

                // AJAX (Fetch) Sorğusu
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
                        // Düyməni normal vəziyyətinə qaytar
                        btnCart.innerHTML = originalText;
                        btnCart.disabled = false;

                        if (data.success) {

                            // 1. Header-dəki bütün köhnə səbət sayğaclarını yenilə
                            document.querySelectorAll('.cart-item').forEach(el => {
                                el.innerText = data.cart_count;
                            });

                            // 2. Sağ panelin başlığındakı sayı yenilə -> Səbətiniz (X)
                            document.querySelectorAll('.sidebar-cart-count').forEach(el => {
                                el.innerText = data.cart_count;
                            });

                            // 3. Sağ panelin aşağısındakı Ümumi məbləği yenilə
                            let totalAmount = data.cart_total ?? '0.00';
                            var totalContainer = document.getElementById('sidebar-cart-total');
                            if (totalContainer) {
                                totalContainer.innerText = totalAmount + ' AZN';
                            }

                            // 4. Panel daxilindəki məhsul siyahısı konteyneri
                            var itemsContainer = document.getElementById('sidebar-cart-items');

                            if (itemsContainer) {
                                // Əgər backend sizə bütün səbət siyahısını array olaraq qaytarırsa:
                                if (data.cart_items && data.cart_items.length > 0) {
                                    itemsContainer.innerHTML = ''; // təmizlə
                                    data.cart_items.forEach(item => {
                                        itemsContainer.innerHTML += `
                                    <div class="cart-sidebar-item">
                                        <img src="${item.image_url}" class="cart-item-img" alt="${item.name}">
                                        <div class="cart-item-details">
                                            <h4 class="cart-item-name">${item.name}</h4>
                                            <div class="cart-item-price">${item.price} AZN</div>
                                            <div class="sidebar-qty-group">
                                                <input type="number" value="${item.quantity}" class="sidebar-qty-input" readonly>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                    });
                                }
                                // Əgər backend array qaytarmırsa, yeni əlavə etdiyimiz data- atributlarından oxuyub tək göstərsin:
                                else if (productCard) {
                                    let pName = productCard.getAttribute('data-name') || 'Məhsul';
                                    let pImg = productCard.getAttribute('data-img') || '';
                                    let pPrice = productCard.getAttribute('data-price') || '0.00';

                                    itemsContainer.innerHTML = `
                                <div class="cart-sidebar-item">
                                    <img src="${pImg}" class="cart-item-img" alt="${pName}">
                                    <div class="cart-item-details">
                                        <h4 class="cart-item-name">${pName}</h4>
                                        <div class="cart-item-price">${pPrice} AZN</div>
                                        <div class="sidebar-qty-group" style="border:none;">
                                            <span style="font-size: 13px; color: #666;">Say: <strong>${quantity}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            `;
                                }
                            }

                            // 5. Hər şey hazırdırsa, Modalı və Qaraltını sağdan ekrana gətir
                            if (sidebar && overlay) {
                                sidebar.classList.add('open');
                                overlay.classList.add('open');
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
</script>

<script>
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
