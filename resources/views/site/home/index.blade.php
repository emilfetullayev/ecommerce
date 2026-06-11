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
                                    <div class="grainger-product-card"
                                         data-product-id="{{ $data->id }}"
                                         data-name="{{ $name }}"
                                         data-price="{{ number_format($data->discount_price, 2) }}"
                                         data-img="{{ asset('storage/'.$img) }}">

                                        <div class="grainger-img-wrapper">
                                            <a href="{{ route('web.product.show', $data->id) }}">
                                                <img src="{{ asset('storage/'.$img) }}" class="img-responsive" alt="{{ $name }}">
                                            </a>
                                        </div>

                                        <div class="grainger-info-wrapper">
                                            <div class="grainger-top-meta">
                <span class="grainger-brand">
                    {{ $data->category?->translations->firstWhere('locale', app()->getLocale())?->name ?? $data->category?->translations->firstWhere('locale', 'az')?->name }}
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
                                                    <span class="price-amount">{{ number_format($data->discount_price, 2) }}</span>
                                                </div>
                                            </div>

                                            <div class="grainger-action-block">
                                                <div class="quantity-wrapper">
                                                    <div class="qty-control-group">
                                                        <button type="button" class="qty-btn grainger-qty-minus">-</button>
                                                        <input type="number" value="1" min="1" class="qty-input grainger-qty-input">
                                                        <button type="button" class="qty-btn grainger-qty-plus">+</button>
                                                    </div>
                                                </div>
                                                @if(auth()->guard('company')->check())
                                                    <button type="button" class="btn-cart grainger-btn-cart">Sepete ekle</button>
                                                @else
                                                    <button type="button" onclick="window.location.href='{{ route('company.login') }}'" class="btn-login ">Sepete ekle</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>                            @endforeach
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
                                                    <span class="price-amount">{{ number_format($price, 2) }} ₼</span>
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
                                                @if(auth()->guard('company')->check())
                                                <button type="button" class="btn-cart grainger-btn-cart">
                                                    Sepete ekle
                                                </button>

                                                @else
                                                    <button type="button" onclick="window.location.href='{{ route('company.login') }}'" class="btn-login ">
                                                        Sepete ekle
                                                    </button>
                                                @endif

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
