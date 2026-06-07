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

        </div>
    </div>
@endsection
