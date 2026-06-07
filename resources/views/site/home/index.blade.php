@extends('site.layouts.app')


@section('content')
    <div id="common-home">
        <div class="slideshow">
            <div class="swiper-viewport">
                <div id="slideshow0" class="swiper-container">
                    <div class="swiper-wrapper">

                        @foreach($featuredProducts as $product)

                            @php
                                $translation = $product->translations()
                                    ->where('locale', app()->getLocale())
                                    ->first()
                                    ?? $product->translations()
                                        ->where('locale', 'az')
                                        ->first();

                                $name = $translation->name ?? $product->name ?? '';
                                $description = $translation->description ?? $product->description ?? '';

                                // DEFAULT retail price
                                $price = $product->retail_price;

                                // company varsa və wholesale seçilibsə
                                if (
                                    auth()->guard('company')->check() &&
                                    auth()->guard('company')->user()->price_type === 'wholesale'
                                ) {
                                    $price = $product->wholesale_price;
                                }

                                $img = optional($product->images->first())->image;
                            @endphp

                            <div class="swiper-slide">

                                <div class="main-slide-container">

                                    <!-- IMAGE -->
                                    <div class="slide-image-side">

                                        @if($img)
                                            <img src="{{ asset('storage/'.$img) }}"
                                                 alt="{{ $name }}">
                                        @else
                                            <img src="{{ asset('web/image/no-image.png') }}"
                                                 alt="{{ $name }}">
                                        @endif

                                    </div>

                                    <!-- CONTENT -->
                                    <div class="slide-content-side">

                                        <!-- DESCRIPTION -->
                                        <span class="sub-title">
                    {{ Str::limit($description, 80) }}
                </span>

                                        <!-- TITLE -->
                                        <h2 class="main-title">
                                            {{ $name }}
                                        </h2>

                                        <!-- PRICE -->
                                        <div class="slide-price">
                                            {{ number_format($price, 2) }} ₼
                                        </div>

                                        <!-- BUTTON -->
                                        <a href="{{ route('web.product.show', $product->id) }}"
                                           class="btn-shop-now">
                                            SHOP NOW
                                        </a>

                                    </div>

                                </div>

                            </div>

                        @endforeach
                    </div>
                </div>

                <div class="swiper-pager">
                    <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                    <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <script><!--
            $('#slideshow0').swiper({
                mode: 'horizontal',
                slidesPerView: 1,
                paginationType: 'progress',
                pagination: '.slideshow0',
                paginationClickable: true,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                watchActiveIndex: true,
                onSlideChangeStart: function (swiper) {
                    $(".slide-progress").css({
                        width: 0,
                        transition: "width 0s",
                    });
                },
                onSlideChangeEnd: function (swiper) {
                    $(".slide-progress").css({
                        width: "100%",
                        transition: "width 5000ms",
                    });
                },
                spaceBetween: 0,
                autoplay: 5000,
                autoplayDisableOnInteraction: true,
                loop: true
            });
            --></script>

        <script><!--
            $('#carousel0').swiper({
                mode: 'horizontal',
                slidesPerView: 8,
                paginationClickable: false,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                loop: true,
                autoplay: 5000,
                autoplayDisableOnInteraction: true,
                breakpoints: {
                    1440: {
                        slidesPerView: 7,
                        spaceBetween: 0
                    },
                    1199: {
                        slidesPerView: 6,
                        spaceBetween: 0
                    },
                    991: {
                        slidesPerView: 5,
                        spaceBetween: 0
                    },
                    767: {
                        slidesPerView: 4,
                        spaceBetween: 0
                    },
                    600: {
                        slidesPerView: 3,
                        spaceBetween: 0
                    },
                    375: {
                        slidesPerView: 2,
                        spaceBetween: 0
                    },
                    300: {
                        slidesPerView: 1,
                        spaceBetween: 0
                    }
                }
            });
            --></script>

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
                margin-bottom: 15px !important;
                margin-top: 8px !important;
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
            .btn-sepete-ekle {
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

            .btn-sepete-ekle:hover {
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
                    margin-bottom: 15px !important;
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

                /* Səbətə atma düyməsi mobildə daha dolğun və oxunaqlı olur */
                .btn-sepete-ekle {
                    flex: 1 !important;
                    height: 40px !important;
                    line-height: 38px !important;
                    font-size: 14px !important;
                    text-align: center !important;
                    border-radius: 6px !important;
                }
            }

            /* Çox xırda ekranlı smartfonlar üçün (max-width: 360px) */
            @media (max-width: 360px) {
                .grainger-action-block {
                    flex-direction: column !important; /* Ekran tam daralanda elementlər alt-alta səliqəli düşür */
                    align-items: stretch !important;
                }

                .quantity-wrapper {
                    justify-content: space-between !important;
                    margin-bottom: 8px !important;
                }
            }
        </style>

        <div class="product-tab-block box">
            <div class="container">
                <div class="related-products-block" style="margin-top: -50px;">
                    <div class="box-content box">

                        <div class="page-title">
                            <h3 class="grainger-main-heading">Endirimdə Olan Məhsullar</h3>
                        </div>

                        <div class="row display-flex-row">
                            @foreach($discounted as $data)
                                @php
                                    $locale = app()->getLocale();
                                    $translation = $data->translations->firstWhere('locale', $locale);

                                    if (!$translation) {
                                        $translation = $data->translations->firstWhere('locale', 'az');
                                    }

                                    $name = $translation?->name ?? '';

                                    $price = $data->retail_price;

                                    if (
                                        auth()->guard('company')->check() &&
                                        auth()->guard('company')->user()->price_type === 'wholesale'
                                    ) {
                                        $price = $data->wholesale_price;
                                    }

                                    $img = optional($data->images->first())->image;
                                @endphp

                                <div class="col-xs-12 col-sm-6 col-md-4 product-layout">
                                    <div class="grainger-product-card" data-product-id="{{ $data->id }}">
                                        <div class="grainger-img-wrapper">
                                            <a href="{{ route('web.product.show', $data->id) }}">
                                                <img src="{{ asset('storage/'.$img) }}" class="img-responsive"
                                                     alt="{{ $name }}">
                                            </a>
                                        </div>

                                        <div class="grainger-info-wrapper">
                                            <div class="grainger-top-meta">
                                               <span class="grainger-brand">
    {{ $data->category?->translations
        ->firstWhere('locale', app()->getLocale())
        ?->name
        ?? $data->category?->translations->firstWhere('locale', 'az')?->name }}
</span>
                                                <h4 class="grainger-title">
                                                    <a href="{{ route('web.product.show', $data->id) }}">{{ $name }}</a>
                                                </h4>
                                                <div class="grainger-sku">Məhsul kodu {{ $data->code ?? '' }}</div>
                                            </div>

                                            <div class="grainger-price-block">
                                                <span class="price-label">Qiyməti</span>
                                                <div class="price-row">
                                                    <span class="price-old"> {{ number_format($price, 2) }}</span>
                                                    <span
                                                        class="price-amount">{{ number_format($data->discount_price, 2) }}</span>
                                                </div>
                                            </div>

                                            <div class="grainger-action-block">
                                                <div class="quantity-wrapper">
                                                    <div class="qty-control-group">
                                                        <button type="button" class="qty-btn grainger-qty-minus">-
                                                        </button>
                                                        <input type="number" value="1" min="1"
                                                               class="qty-input grainger-qty-input">
                                                        <button type="button" class="qty-btn grainger-qty-plus">+
                                                        </button>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-sepete-ekle grainger-btn-cart">Sepete
                                                    ekle
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="product-tab-block box">
            <div class="container">
                <div class="related-products-block" style="margin-top: -50px;">
                    <div class="box-content box">

                        <div class="page-title">
                            <h3 class="grainger-main-heading">Məhsullar</h3>
                        </div>

                        <div class="row display-flex-row">
                            @foreach($products as $data)
                                @php
                                    $translation = $data->translations->where('locale', app()->getLocale())->first()
                                        ?? $data->translations->where('locale', 'az')->first();

                                    $name = $translation->name ?? $data->name;
                                    $price = $data->retail_price;

                                    if (
                                        auth()->guard('company')->check() &&
                                        auth()->guard('company')->user()->price_type === 'wholesale'
                                    ) {
                                        $price = $data->wholesale_price;
                                    }

                                    $img = optional($data->images->first())->image;
                                @endphp

                                <div class="col-xs-12 col-sm-6 col-md-4 product-layout">
                                    <div class="grainger-product-card" data-product-id="{{ $data->id }}">

                                        {{-- SOL HİSSƏ: ŞƏKİL --}}
                                        <div class="grainger-img-wrapper">
                                            <a href="{{ route('web.product.show', $data->id) }}">
                                                @if($img)
                                                    <img src="{{ asset('storage/'.$img) }}" class="img-responsive"
                                                         alt="{{ $name }}">
                                                @else
                                                    <img src="{{ asset('web/image/no-image.png') }}"
                                                         class="img-responsive" alt="{{ $name }}">
                                                @endif
                                            </a>
                                        </div>

                                        {{-- SAĞ HİSSƏ: MƏLUMATLAR --}}
                                        <div class="grainger-info-wrapper">

                                            <div class="grainger-top-meta">
                                                <span class="grainger-brand"><span class="grainger-brand">
    {{ $data->category?->translations
        ->firstWhere('locale', app()->getLocale())
        ?->name
        ?? $data->category?->translations->firstWhere('locale', 'az')?->name }}
</span></span>
                                                <h4 class="grainger-title">
                                                    <a href="{{ route('web.product.show', $data->id) }}">{{ $name }}</a>
                                                </h4>
                                                <div class="grainger-sku">Məhsul kodu {{ $data->code ?? '' }}</div>
                                            </div>

                                            <div class="grainger-price-block">
                                                <span class="price-label">Qiyməti</span>
                                                <div class="price-row">
                                                    <span class="price-amount">${{ number_format($price, 2) }}</span>
                                                </div>
                                            </div>

                                            {{-- ALT HİSSƏ: ARTIQ BORDER-SİZ MİNİMALİST DİZAYN --}}
                                            <div class="grainger-action-block">
                                                <div class="quantity-wrapper">
                                                    <div class="qty-control-group">
                                                        <button type="button" class="qty-btn grainger-qty-minus">-
                                                        </button>
                                                        <input type="number" value="1" min="1"
                                                               class="qty-input grainger-qty-input">
                                                        <button type="button" class="qty-btn grainger-qty-plus">+
                                                        </button>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn-sepete-ekle grainger-btn-cart">
                                                    Sepete ekle
                                                </button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <script type="text/javascript">
            $('#tabs a').tabs();

            // set slider
            // const direction = $('html').attr('dir');
            // $('.product-tab-carousel').each(function () {
            // 	if ($(this).closest('#column-left').length == 0 && $(this).closest('#column-right').length == 0) {
            // 		$(this).addClass('owl-carousel owl-theme');
            // 		const items = $(this).data('items') || 5;
            // 		const sliderOptions = {
            // 			loop: false,
            // 			nav: true,
            // 			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            // 			dots: false,
            // 			items: items,
            // 			responsiveRefreshRate: 200,
            // 			responsive: {
            // 				0: { items: 1 },
            // 				426: { items: ((items - 3) > 1) ? (items - 3) : 1 },
            // 				681: { items: ((items - 2) > 1) ? (items - 2) : 1 },
            // 				992: { items: ((items - 1) > 1) ? (items - 1) : 1 },
            // 				1200: { items: items }
            // 			}
            // 		};
            // 		if (direction == 'rtl') sliderOptions['rtl'] = true;
            // 		$(this).owlCarousel(sliderOptions);
            // 	}
            // });
        </script>


    </div>
    <!-- top scroll -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Səhifədəki bütün plus (+) düymələrini tapıb işlədirik
            document.querySelectorAll('.qty-plus').forEach(function (button) {
                button.addEventListener('click', function () {
                    let input = this.parentElement.querySelector('.qty-input');
                    let currentValue = parseInt(input.value) || 1;
                    input.value = currentValue + 1;
                });
            });

            // Səhifədəki bütün minus (-) düymələrini tapıb işlədirik
            document.querySelectorAll('.qty-minus').forEach(function (button) {
                button.addEventListener('click', function () {
                    let input = this.parentElement.querySelector('.qty-input');
                    let currentValue = parseInt(input.value) || 1;
                    if (currentValue > 1) {
                        input.value = currentValue - 1;
                    }
                });
            });
        });
    </script>
@endsection
