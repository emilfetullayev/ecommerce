@extends('site.layouts.app')

@section('content')
    <div id="product-category" class="container">
        @include('site.partials.breadcrumb')

        <div class="row">

            <div id="common-home">
                <div class="product-tab-block  box">
                    <div class="container">
                        <div class="main-tab">

                            <div class="related-products-block">
                                <div class="box-content box">

                                    <div class="page-title">
                                        <h3>Products</h3>
                                    </div>

                                    <div class="row">

                                        @foreach($products as $data)

                                            @php
                                                $translation = $data->translations->where('locale', app()->getLocale())->first()
                                                    ?? $data->translations->where('locale', 'az')->first();

                                                $name = $translation->name ?? $data->name;
                                                $description = $translation->description ?? $data->description;

                                                // DEFAULT retail price
                                                $price = $data->retail_price;

                                                // company login + wholesale check
                                                if (
                                                    auth()->guard('company')->check() &&
                                                    auth()->guard('company')->user()->price_type === 'wholesale'
                                                ) {
                                                    $price = $data->wholesale_price;
                                                }

                                                $img = optional($data->images->first())->image;
                                            @endphp

                                            <div class="product-layout col-xs-12 col-sm-6 col-md-3">

                                                <div class="custom-product-card">

                                                    {{-- IMAGE --}}
                                                    <div class="product-img-wrapper">
                                                        <a href="{{ route('web.product.show', $data->id) }}">

                                                            @if($img)
                                                                <img src="{{ asset('storage/'.$img) }}"
                                                                     class="img-responsive main-img"
                                                                     alt="{{ $name }}">
                                                            @else
                                                                <img src="{{ asset('web/image/no-image.png') }}"
                                                                     class="img-responsive main-img"
                                                                     alt="{{ $name }}">
                                                            @endif

                                                        </a>

                                                        {{-- ADD TO CART HOVER --}}
                                                        <div class="pro-addcart">
                                                            <button type="button" class="addcart"
                                                                    onclick="window.location.href='{{ route('web.product.show', $data->id) }}'">
                                                                <i class="icon-bag"></i>
                                                                <span>Add to Cart</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    {{-- INFO --}}
                                                    <div class="product-info-wrapper">

                                                        <h4 class="product-title">
                                                            <a href="{{ route('web.product.show', $data->id) }}">
                                                                {{ $name }}
                                                            </a>
                                                        </h4>

                                                        <div class="pro-price">
                    <span class="price-new">
                        ${{ number_format($price, 2) }}
                    </span>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                        @endforeach
                                    </div>

                                    <div class="text-center mt-30">
                                        {{ $products->onEachSide(2)->links('pagination::bootstrap-4') }}                                    </div>
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
