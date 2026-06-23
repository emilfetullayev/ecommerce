@extends('site.layouts.app')

@section('content')
    <div id="product-category" class="container">
        @include('site.partials.breadcrumb')

        <div class="row">

            <div id="common-home">
                <div class="product-tab-block box">
                    <div class="container">
                        <div class="related-products-block" style="margin-top: -50px;">
                            <div class="box-content box">
                                <div class="page-title">
                                    <h3 class="grainger-main-heading">  {{ t('products') }}</h3>
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

                                        <div class="col-xs-12 col-sm-6 col-md-3 product-layout">
                                            <div class="grainger-product-card style-ad-card"
                                                 data-product-id="{{ $data->id }}">

                                                <div class="ad-image-box">
                                                    <a href="{{ route('web.product.show', $data->id) }}">
                                                        @if($img)
                                                            <img src="{{ asset('storage/'.$img) }}"
                                                                 class="img-responsive" alt="{{ $name }}">
                                                        @else
                                                            <img src="{{ asset('web/image/no-image.png') }}"
                                                                 class="img-responsive" alt="{{ $name }}">
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
                                                        <div class="grainger-sku">Məhsul
                                                            kodu {{ $data->code ?? '' }}</div>
                                                    </div>
                                                    @if(auth()->guard('company')->check())
                                                        <div class="grainger-price-block">
                                                            <span class="price-label">Qiyməti</span>
                                                            <div class="price-row">
                                                                <span class="price-amount">{{ number_format($price, 2) }} ₼</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="grainger-action-block">
                                                        <div class="quantity-wrapper">
                                                            <div class="qty-control-group">
                                                                <button type="button"
                                                                        class="qty-btn grainger-qty-minus">-
                                                                </button>
                                                                <input type="number" value="1" min="1"
                                                                       class="qty-input grainger-qty-input">
                                                                <button type="button" class="qty-btn grainger-qty-plus">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                        @if(auth()->guard('company')->check())
                                                            <button type="button"
                                                                    class="btn-cart grainger-btn-cart"> {{ t('add_to_cart') }}</button>
                                                        @else
                                                            <button type="button"
                                                                    onclick="window.location.href='{{ route('company.login') }}'"
                                                                    class="btn-login">{{ t('add_to_cart') }}</button>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="product-loader" class="text-center"
                                     style="display: none; padding: 30px; width: 100%;">
                                    <p><i class="fa fa-spinner fa-spin"
                                          style="font-size:32px; color: #333;"></i> {{ t('loading_products') }}</p>
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

        </div>
    </div>


    <script type="text/javascript">
        let page = 1;
        let isLoading = false;
        let hasMoreData = true;

        $(window).scroll(function () {
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
                dataType: 'json',
                beforeSend: function () {
                    isLoading = true;
                    $('#product-loader').show();
                }
            })
                .done(function (response) {
                    if (!response.html || response.html.trim() === "") {
                        hasMoreData = false;
                        $('#product-loader').html('<p class="text-muted" style="font-weight: bold; padding: 10px;">Bütün məhsullar yükləndi.</p>').show();
                        return;
                    }

                    $('#product-container').append(response.html);
                    $('#product-loader').hide();
                    isLoading = false;

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
