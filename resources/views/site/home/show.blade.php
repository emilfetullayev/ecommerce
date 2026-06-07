
@extends('site.layouts.app')


@section('content')
<div id="product-page" class="container">
    @include('site.partials.breadcrumb')
    <div class="row">
        <div id="content" class="col-sm-12">

            @php
                $translation = $product->translations->where('locale', app()->getLocale())->first()
                    ?? $product->translations->where('locale', 'az')->first();

                $name = $translation->name ?? $product->name;
                $description = $translation->description ?? $product->description;

                // Bazadakı standart qiymət (Pərakəndə və ya Topdan)
                $normalPrice = ($product->price_type === 'wholesale')
                    ? $product->wholesale_price
                    : $product->retail_price;

                // Əgər endirim aktivdirsə (is_discounted == 1 və discount_price boş deyilsə)
                if ($product->is_discounted == 1 && !empty($product->discount_price)) {
                    $currentPrice = $product->discount_price; // Satış qiyməti endirimli qiymət olur
                    $oldPrice = $normalPrice;                // Üstü xəttli qiymət köhnə qiymət olur
                    $hasDiscount = true;
                } else {
                    $currentPrice = $normalPrice;
                    $oldPrice = null;
                    $hasDiscount = false;
                }
            @endphp

            <h2 class="page_title">{{ $name }}</h2>
            <div class="pro-deatil row">
                <div class="col-sm-6 product-img">
                    <div class="thumbnails">
                        <div class="product-additional">
                            <div class="pro-image">
                                @if($product->images && $product->images->first())
                                    <a href="{{ asset('storage/' . $product->images->first()->image) }}"
                                       title="{{ $product->name }}" class="thumbnail">
                                        <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                             title="{{ $name }}"
                                             id="zoom"
                                             alt="{{ $name }}"
                                             data-zoom-image="{{ asset('storage/' . $product->images->first()->image) }}"
                                             style="background-color: transparent !important; object-fit: contain !important; max-height: 450px; width: 100%;"/>
                                    </a>
                                @else
                                    <a href="{{ asset('web/image/no-image.png') }}" title="{{ $name }}"
                                       class="thumbnail">
                                        <img src="{{ asset('web/image/no-image.png') }}" title="{{ $name}}" id="zoom"
                                             alt="{{ $name }}" data-zoom-image="{{ asset('web/image/no-image.png') }}"/>
                                    </a>
                                @endif
                            </div>

                            <div id="additional-carousel" class="owl-carousel owl-theme clearfix">
                                @if($product->images && $product->images->count() > 0)
                                    @foreach($product->images as $image)
                                        <div class="image-additional">
                                            <a href="{{ asset('storage/' . $image->image) }}"
                                               title="{{ $name }}"
                                               class="elevatezoom-gallery"
                                               data-image="{{ asset('storage/' . $image->image) }}"
                                               data-zoom-image="{{ asset('storage/' . $image->image) }}">
                                                <img src="{{ asset('storage/' . $image->image) }}"
                                                     title="{{ $name }}"
                                                     alt="{{ $name }}"
                                                     width="100"
                                                     height="133"
                                                     style="object-fit: contain !important; background-color: transparent !important;"/>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="image-additional">
                                        <a href="{{ asset('web/image/no-image.png') }}" title="{{ $name }}"
                                           class="elevatezoom-gallery"
                                           data-image="{{ asset('web/image/no-image.png') }}"
                                           data-zoom-image="{{ asset('web/image/no-image.png') }}">
                                            <img src="{{ asset('web/image/no-image.png') }}" title="{{ $name }}"
                                                 alt="{{ $name }}" width="100" height="133"/>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 right_info">
                    <h1 class="">{{ $name }}</h1>
                    <hr>
                    {!! $description !!}
                    <hr>
                    <ul class="list-unstyled">
                        <li>
                            <div class="detail-price-block" style="display: block !important; margin: 10px 0 !important;">
                                <span class="detail-price-label" style="display: block !important; font-size: 14px; color: #555; margin-bottom: 5px; font-weight: 600;">Web Fiyatı</span>
                                <div class="detail-price-row" style="display: flex !important; align-items: baseline !important; gap: 10px !important;">
                                    @if($hasDiscount)
                                        <span class="price-old-detail" style="font-size: 18px !important; color: #a5a5a5 !important; text-decoration: line-through !important; -webkit-text-decoration-line: line-through !important; font-weight: normal !important; display: inline-block !important;">
                                        ${{ number_format($oldPrice, 2) }}
                                    </span>
                                    @endif
                                    <span class="price-amount-detail" style="font-size: 32px !important; font-weight: 800 !important; color: #007a3d !important; display: inline-block !important;">
                                    ${{ number_format($currentPrice, 2) }}
                                </span>
                                    <span class="price-unit-detail" style="font-size: 15px !important; color: #555 !important; font-weight: normal !important; display: inline-block !important;">/ adet</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <hr>

                    <div id="product" class="product-options">
                        <div class="form-group">
                            <div class="product-btn-quantity">
                                <label class="control-label qty" for="input-quantity">Qty</label>

                                <div class="minus-plus">
                                    <button type="button" class="minus detal-qty-minus"><i class="fa fa-minus"></i></button>
                                    <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control"/>
                                    <button type="button" class="plus detal-qty-plus"><i class="fa fa-plus"></i></button>
                                </div>

                                @if(auth()->guard('company')->check())
                                    <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary btn-lg btn-block">
                                        <i class="icon-bag"></i><span>Add to Cart</span>
                                    </button>
                                @else
                                    <button type="button" id="fake-button-cart" onclick="window.location.href='{{ route('company.login') }}'" data-loading-text="Loading..." class="btn btn-primary btn-lg btn-block">
                                        <i class="icon-bag"></i><span>Add to Cart</span>
                                    </button>
                                @endif

                                <input type="hidden" name="product_id" id="main-product-id" value="{{ $product->id }}"/>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="addthis_toolbox addthis_default_style" data-url="index6320.html?route=product/product&amp;product_id=28">
                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                        <a class="addthis_button_tweet"></a>
                        <a class="addthis_button_pinterest_pinit"></a>
                        <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <script type="text/javascript" src="../../../../s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="row propage-tab">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-description">
                            {!! $description !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-tab-block box">
                <div class="container">
                    <div class="related-products-block" style="margin-top: -50px;">
                        <div class="box-content box">

                            <div class="page-title">
                                <h3 class="grainger-main-heading">Əlaqəli Məhsullar</h3>
                            </div>

                            <div class="row display-flex-row">
                                @foreach($relatedProducts as $data)
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

        </div>
    </div>


</div>


@endsection
