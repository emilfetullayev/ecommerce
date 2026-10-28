@extends('site.layouts.app')


@section('content')
    {{-- Yalnız yazıların sağdakı boşluğu doldurması üçün tənzimlənmiş CSS --}}
    {{-- STOK BİTİB STİLLƏRİ (bu səhifə üçün) --}}
    <style>
        .grainger-product-card .ad-image-box {
            position: relative;
            overflow: hidden;
        }

        .card-out-of-stock .ad-image-box img {
            filter: grayscale(100%);
            opacity: .5;
            transition: .3s;
        }
        .card-out-of-stock:hover .ad-image-box img {
            opacity: .65;
        }

        .oos-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            z-index: 2;
        }
        .oos-overlay-text {
            background: rgba(33, 37, 41, .85);
            color: #fff;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .3px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .25);
        }

        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
            font-size: 12px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }
        .stock-status .stock-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }
        .stock-status--out {
            color: #c62828;
            background: #ffebee;
        }
        .stock-status--out .stock-dot {
            background: #e53935;
        }

        .btn-out-of-stock {
            width: 100%;
            padding: 10px;
            background: #f1f1f1;
            color: #9e9e9e;
            border: 1px dashed #cfcfcf;
            border-radius: 4px;
            font-weight: 600;
            cursor: not-allowed;
        }
    </style>
    <div id="product-page" class="container" style="margin-top: 40px;">
        @include('site.partials.breadcrumb')
        <div class="row">
            <div id="content" class="col-sm-12">

                @php
                    $translation = $product->translations->where('locale', app()->getLocale())->first()
                        ?? $product->translations->where('locale', 'az')->first();

                    $name = $translation->name ?? $product->name;
                    $description = $translation->description ?? $product->description;

                    $normalPrice = ($product->price_type === 'wholesale')
                        ? $product->wholesale_price
                        : $product->retail_price;

                    if ($product->is_discounted == 1 && !empty($product->discount_price)) {
                        $currentPrice = $product->discount_price;
                        $oldPrice = $normalPrice;
                        $hasDiscount = true;
                    } else {
                        $currentPrice = $normalPrice;
                        $oldPrice = null;
                        $hasDiscount = false;
                    }
                @endphp

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
                                            <img src="{{ asset('web/image/no-image.png') }}" title="{{ $name}}"
                                                 id="zoom"
                                                 alt="{{ $name }}"
                                                 data-zoom-image="{{ asset('web/image/no-image.png') }}"/>
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
                        @if(auth()->guard('company')->check())

                        <ul class="list-unstyled">
                            <li>
                                    <div class="detail-price-block"
                                         style="display: block !important; margin: 10px 0 !important;">
                                        <span class="detail-price-label"
                                              style="display: block !important; font-size: 14px; color: #555; margin-bottom: 5px; font-weight: 600;"> {{ t('product_price') }}</span>
                                        <div class="detail-price-row"
                                             style="display: flex !important; align-items: baseline !important; gap: 10px !important;">
                                            @if($hasDiscount)
                                                <span class="price-old-detail"
                                                      style="font-size: 18px !important; color: #a5a5a5 !important; text-decoration: line-through !important; -webkit-text-decoration-line: line-through !important; font-weight: normal !important; display: inline-block !important;">
                                        {{ number_format($oldPrice, 2) }} ₼
                                    </span>
                                            @endif
                                            <span class="price-amount-detail"
                                                  style="font-size: 32px !important; font-weight: 800 !important; color: #007a3d !important; display: inline-block !important;">
                                    {{ number_format($currentPrice, 2) }} ₼
                                </span>
                                            <span class="price-unit-detail"
                                                  style="font-size: 15px !important; color: #555 !important; font-weight: normal !important; display: inline-block !important;">/ {{ t('count') }}</span>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        </ul>
                        <hr>

                            @php
                                $outOfStock = (int) $product->stock <= 0;
                            @endphp

                            <div id="product" class="product-options">
                                <div class="form-group">
                                    <div class="product-btn-quantity">

                                        @if($outOfStock)
                                            <div class="detail-oos-box">
                                                <i class="fa fa-ban detail-oos-icon"></i>
                                                <div>
                                                    <div class="detail-oos-title">Stokda yoxdur</div>
                                                    <div class="detail-oos-text">Bu məhsul hazırda stokda yoxdur</div>
                                                </div>
                                            </div>
                                        @else
                                            <label class="control-label qty" for="input-quantity">{{ t('count') }}</label>

                                            <div class="minus-plus">
                                                <button type="button" class="minus detal-qty-minus"><i class="fa fa-minus"></i>
                                                </button>
                                                <input type="text" name="quantity" value="1" size="2" id="input-quantity"
                                                       data-max="{{ $product->stock }}"
                                                       class="form-control"/>
                                                <button type="button" class="plus detal-qty-plus"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>

                                            @if(auth()->guard('company')->check())
                                                <button type="button" id="button-cart" data-loading-text="Loading..."
                                                        class="btn btn-primary btn-lg btn-block">
                                                    <i class="icon-bag"></i><span>{{ t('add_to_cart') }}</span>
                                                </button>
                                            @else
                                                <button type="button" id="fake-button-cart"
                                                        onclick="window.location.href='{{ route('company.login') }}'"
                                                        data-loading-text="Loading..." class="btn btn-primary btn-lg btn-block">
                                                    <i class="icon-bag"></i><span>{{ t('add_to_cart') }}</span>
                                                </button>
                                            @endif
                                        @endif

                                        <input type="hidden" name="product_id" id="main-product-id"
                                               value="{{ $product->id }}"/>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .detail-oos-box {
                                    flex: 1 1 100%;
                                    width: 100%;
                                    display: flex;
                                    align-items: center;
                                    gap: 14px;
                                    padding: 16px 20px;
                                    background: #fff5f5;
                                    border: 1px solid #f5c2c7;
                                    border-left: 4px solid #e53935;
                                    border-radius: 6px;
                                }
                                .detail-oos-icon {
                                    font-size: 26px;
                                    color: #e53935;
                                }
                                .detail-oos-title {
                                    font-size: 16px;
                                    font-weight: 700;
                                    color: #c62828;
                                    line-height: 1.3;
                                }
                                .detail-oos-text {
                                    font-size: 13px;
                                    color: #8a6d6d;
                                    margin-top: 2px;
                                }
                            </style>

                            <script>
                                $(document).on('click', '.detal-qty-plus', function () {
                                    let input = $('#input-quantity');
                                    let current = parseInt(input.val()) || 1;
                                    let max = parseInt(input.data('max')) || Infinity;
                                    if (current < max) input.val(current + 1);
                                });

                                $(document).on('click', '.detal-qty-minus', function () {
                                    let input = $('#input-quantity');
                                    let current = parseInt(input.val()) || 1;
                                    if (current > 1) input.val(current - 1);
                                });

                                $(document).on('change keyup', '#input-quantity', function () {
                                    let max = parseInt($(this).data('max')) || Infinity;
                                    let val = parseInt($(this).val()) || 1;
                                    if (val > max)                        <hr>

                        <div class="addthis_toolbox addthis_default_style"
                             data-url="index6320.html?route=product/product&amp;product_id=28">
                            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                            <a class="addthis_button_tweet"></a>
                            <a class="addthis_button_pinterest_pinit"></a>
                            <a class="addthis_counter addthis_pill_style"></a>
                        </div>
                        <script type="text/javascript"
                                src="../../../../s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row propage-tab">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-description" data-toggle="tab">{{ t('description') }}</a>
                            </li>
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
                                    <h3 class="grainger-main-heading"> {{ t('related_products') }}</h3>
                                </div>

                                <div class="row display-flex-row" id="product-container">
                                    @foreach($relatedProducts as $data)
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

                                            $outOfStock = (int) $data->stock <= 0;
                                        @endphp

                                        <div class="col-xs-12 col-sm-6 col-md-3 product-layout">
                                            <div class="grainger-product-card style-ad-card {{ $outOfStock ? 'card-out-of-stock' : '' }}"
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

                                                    @if($outOfStock)
                                                        <div class="oos-overlay">
                                                            <span class="oos-overlay-text">
                                                                <i class="fa fa-ban"></i> Stokda yoxdur
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="grainger-info-wrapper">
                                                    <div class="grainger-top-meta">
                                                <span class="grainger-brand">
                                                {{ $data->category?->translations->firstWhere('locale', app()->getLocale())?->name ?? $data->category?->translations->firstWhere('locale', 'az')?->name }}
                                                </span>
                                                        <h4 class="grainger-title">
                                                            <a href="{{ route('web.product.show', $data->id) }}">{{ $name }}</a>
                                                        </h4>
                                                        <div
                                                                class="grainger-sku">{{ t('product_code') }} {{ $data->code ?? '' }}</div>

                                                        @if($outOfStock)
                                                            <span class="stock-status stock-status--out">
                                                                <span class="stock-dot"></span> Stokda yoxdur
                                                            </span>
                                                        @endif
                                                    </div>
                                                    @if(auth()->guard('company')->check())

                                                        <div class="grainger-price-block">
                                                            <span class="price-label"> {{ t('product_price') }}</span>
                                                            <div class="price-row">
                                                            <span
                                                                    class="price-amount">{{ number_format($price, 2) }} ₼</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="grainger-action-block">
                                                        @if($outOfStock)
                                                            <button type="button" class="btn-out-of-stock" disabled>
                                                                <i class="fa fa-ban"></i> Stokda yoxdur
                                                            </button>
                                                        @else
                                                            <div class="quantity-wrapper">
                                                                <div class="qty-control-group">
                                                                    <button type="button"
                                                                            class="qty-btn grainger-qty-minus">-
                                                                    </button>
                                                                    <input type="number" value="1" min="1" max="{{ $data->stock }}"
                                                                           class="qty-input grainger-qty-input">
                                                                    <button type="button" class="qty-btn grainger-qty-plus">
                                                                        +
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @if(auth()->guard('company')->check())
                                                                <button type="button"
                                                                        class="btn-cart grainger-btn-cart">{{ t('add_to_cart') }}</button>
                                                            @else
                                                                <button type="button"
                                                                        onclick="window.location.href='{{ route('company.login') }}'"
                                                                        class="btn-login">{{ t('add_to_cart') }}</button>
                                                            @endif
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


            </div>
        </div>


    </div>

@endsection
