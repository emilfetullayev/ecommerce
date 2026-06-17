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
                                    <div class="slide-image-side">
                                        @if($img)
                                            <img src="{{ asset('storage/'.$img) }}" alt="{{ $name }}">
                                        @else
                                            <img src="{{ asset('web/image/no-image.png') }}" alt="{{ $name }}">
                                        @endif
                                    </div>

                                    <div class="slide-content-side">
<span class="sub-title">
{{ Str::limit($description, 80) }}
</span>

                                        <h2 class="main-title">
                                            {{ $name }}
                                        </h2>

                                        <div class="slide-price">
                                            {{ number_format($price, 2) }} ₼
                                        </div>

                                        <a href="{{ route('web.product.show', $product->id) }}" class="btn-shop-now">
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
                                                    <button type="button" onclick="window.location.href='{{ route('company.login') }}'" class="btn-login">Sepete ekle</button>
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

        <div class="product-tab-block box">
            <div class="container">
                <div class="related-products-block" style="margin-top: -50px;">
                    <div class="box-content box">
                        <div class="page-title">
                            <h3 class="grainger-main-heading">Məhsullar</h3>
                        </div>

                        <div class="row display-flex-row" id="product-container">
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
                                        <div class="grainger-img-wrapper">
                                            <a href="{{ route('web.product.show', $data->id) }}">
                                                @if($img)
                                                    <img src="{{ asset('storage/'.$img) }}" class="img-responsive" alt="{{ $name }}">
                                                @else
                                                    <img src="{{ asset('web/image/no-image.png') }}" class="img-responsive" alt="{{ $name }}">
                                                @endif
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
                                                    <span class="price-amount">{{ number_format($price, 2) }} ₼</span>
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
                                                    <button type="button" onclick="window.location.href='{{ route('company.login') }}'" class="btn-login">Sepete ekle</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="product-loader" class="text-center" style="display: none; padding: 30px; width: 100%;">
                            <p><i class="fa fa-spinner fa-spin" style="font-size:32px; color: #333;"></i> Məhsullar yüklənir...</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Swiper Sliders
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
                $(".slide-progress").css({ width: 0, transition: "width 0s" });
            },
            onSlideChangeEnd: function (swiper) {
                $(".slide-progress").css({ width: "100%", transition: "width 5000ms" });
            },
            spaceBetween: 0,
            autoplay: 5000,
            autoplayDisableOnInteraction: true,
            loop: true
        });

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
                1440: { slidesPerView: 7, spaceBetween: 0 },
                1199: { slidesPerView: 6, spaceBetween: 0 },
                991: { slidesPerView: 5, spaceBetween: 0 },
                767: { slidesPerView: 4, spaceBetween: 0 },
                600: { slidesPerView: 3, spaceBetween: 0 },
                375: { slidesPerView: 2, spaceBetween: 0 },
                300: { slidesPerView: 1, spaceBetween: 0 }
            }
        });

        $('#tabs a').tabs();
    </script>

    <script type="text/javascript">
        let page = 1;
        let isLoading = false;
        let hasMoreData = true; // Bazada məhsul bitdikdə sorğuları tamamilə dayandırmaq üçün

        $(window).scroll(function () {
// Səhifənin aşağısına 300px qaldıqda avtomatik növbəti səhifəni çağırır
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
                if (!isLoading && hasMoreData) {
                    page++;
                    loadProducts(page);
                }
            }
        });

        function loadProducts(pageNumber) {
            $.ajax({
                url: '?page=' + pageNumber,
                type: 'GET',
                dataType: 'json', // JSON cavabı gözlədiyimizi bildiririk
                beforeSend: function () {
                    isLoading = true;
                    $('#product-loader').show();
                }
            })
                .done(function (response) {
// Əgər gələn HTML tamamilə boşdursa
                    if (!response.html || response.html.trim() === "") {
                        hasMoreData = false;
                        $('#product-loader').html('<p class="text-muted" style="font-weight: bold; padding: 10px;">Bütün məhsullar yükləndi.</p>').show();
                        return;
                    }

// Gələn təmiz HTML stringini mövcud siyahının sonuna əlavə edirik
                    $('#product-container').append(response.html);
                    $('#product-loader').hide();
                    isLoading = false;

// Controller-də təyin etdiyimiz "hasMore" statusunu yoxlayırıq, false-dursa sürüşdürməni bağlayırıq
                    if (!response.hasMore) {
                        hasMoreData = false;
                        $('#product-loader').html('<p class="text-muted" style="font-weight: bold; padding: 10px;">Bütün məhsullar yükləndi.</p>').show();
                    }
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.error('Xəta baş verdi: ', textStatus, errorThrown);
                    isLoading = false;
                    $('#product-loader').hide();
                });
        }

        // Dinamik gələn yeni məhsulların da + və - düymələrinin işləməsi üçün "Event Delegation"
        $(document).on('click', '.grainger-qty-plus', function () {
            let input = $(this).siblings('.grainger-qty-input');
            let currentValue = parseInt(input.val()) || 1;
            input.val(currentValue + 1);
        });

        $(document).on('click', '.grainger-qty-minus', function () {
            let input = $(this).siblings('.grainger-qty-input');
            let currentValue = parseInt(input.val()) || 1;
            if (currentValue > 1) {
                input.val(currentValue - 1);
            }
        });
    </script>
@endsection
