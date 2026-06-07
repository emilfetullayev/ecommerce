<header>
    <style>
        /* Ümumi struktur mərkəzləşdirmə */
        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 10px 0;
        }

        /* Masaüstü üçün Axtarış sahəsinin konteyneri */
        .header-search-container {
            flex: 1;
            max-width: 600px;
            margin: 0 30px;
        }

        /* Müasir Flex struktur (Düymənin aşağı düşməsini tam əngəlləyir) */
        .header-search-flex {
            display: flex !important;
            width: 100%;
            height: 45px;
            border-radius: 4px;
            overflow: hidden;
            background-color: #fff;
            border: 1px solid #e0e0e0;
        }

        /* Sol tərəf: Select hissəsi */
        .category-selector-flex {
            background: #f5f5f5;
            width: 150px;
            min-width: 140px;
            display: flex;
            align-items: center;
            border-right: 1px solid #e0e0e0;
        }

        .category-selector-flex select {
            height: 100% !important;
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            padding: 0 10px !important;
            width: 100%;
            cursor: pointer;
            color: #333;
            font-size: 13px;
        }

        /* Orta hissə: İnput yazmaq yeri */
        .search-input-flex {
            flex: 1 !important;
            height: 100% !important;
            border: none !important;
            box-shadow: none !important;
            padding-left: 15px !important;
            background: #fff !important;
        }

        /* Sağ tərəf: Sarı SEARCH Düyməsi */
        .btn-search-submit-flex {
            background-color: #ffcc00 !important; /* Sarı rəng */
            color: #000000 !important;
            font-weight: bold !important;
            height: 100% !important;
            border: none !important;
            padding: 0 25px !important;
            border-radius: 0 !important;
            font-size: 14px !important;
            transition: background 0.2s ease;
            letter-spacing: 0.5px;
            white-space: nowrap;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-search-submit-flex:hover {
            background-color: #e6b800 !important;
        }

        /* 📱 MOBİL VƏ PLANŞET ÜÇÜN RESPONSIVE CSS (991px və daha aşağı) */
        @media (max-width: 991px) {
            .header-inner {
                flex-direction: column; /* Elementləri alt-alta düzür */
                text-align: center;
                gap: 15px; /* Elementlər arasında boşluq qoyur */
            }

            #logo, .header-right {
                width: 100%;
                display: flex;
                justify-content: center;
            }

            .header-search-container {
                width: 100%;
                max-width: 100%;
                margin: 5px 0;
                padding: 0 15px; /* Ekranın kənarlarına yapışmasın */
            }

            .category-selector-flex {
                width: 120px; /* Mobilde select bir az kiçilir ki yazıya yer qalsın */
                min-width: 110px;
            }

            .btn-search-submit-flex {
                padding: 0 15px !important; /* Düymə sıxılsın */
            }
        }
    </style>

    <div class="header-top">
        <div class="container">
            <div class="header-inner">

                <div id="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('web/image/logo.jpeg') }}"
                             title="Your Store"
                             alt="Your Store"
                             class="img-responsive"
                             style="max-height: 50px; width: auto;"/>
                    </a>
                </div>

                @php
                    $locale = app()->getLocale();

                    $getName = function ($model) use ($locale) {
                        return $model->translations
                            ->firstWhere('locale', $locale)
                            ?->name
                            ?? $model->translations->firstWhere('locale', 'az')?->name;
                    };

                    $renderOptions = function ($categories, $level = 0) use (&$renderOptions, $getName) {
                        foreach ($categories as $category) {

                            echo '<option value="'.$category->id.'">';
                            echo str_repeat('— ', $level).$getName($category);
                            echo '</option>';

                            if ($category->recursiveChildren && $category->recursiveChildren->count()) {
                                $renderOptions($category->recursiveChildren, $level + 1);
                            }
                        }
                    };
                @endphp

                <form action="{{ route('products.search') }}" method="GET">

                    <div class="header-search-container">

                        <div id="search" class="header-search-flex">

                            {{-- CATEGORY --}}
                            <div class="category-selector-flex">

                                <select name="category_id" class="form-control">

                                    <option value="0">All Categories</option>

                                    @php
                                        $renderOptions($menuCategories);
                                    @endphp

                                </select>

                            </div>

                            {{-- SEARCH INPUT --}}
                            <input type="text"
                                   name="search"
                                   placeholder="Search..."
                                   class="form-control search-input-flex"/>

                            {{-- BUTTON --}}
                            <button type="submit" class="btn-search-submit-flex">
                                SEARCH
                            </button>

                        </div>

                    </div>

                </form>
                <div class="header-right header-links">
                    <div class="header_cart">
                        <div id="cart" class="btn-group btn-block">

                            @php
                                $cart = session('cart', []);
                                $cartCount = array_sum(array_column($cart, 'quantity'));

                                $cartTotal = 0;
                                foreach ($cart as $item) {
                                    $cartTotal += $item['price'] * $item['quantity'];
                                }
                            @endphp

                            <button type="button"
                                    data-toggle="dropdown"
                                    data-loading-text="Loading..."
                                    class="btn btn-inverse btn-block btn-lg dropdown-toggle">

    <span id="cart-total">
        <span class="hidden-sm hidden-xs">My Cart:</span>

        <span class="cart-item">
            {{ $cartCount }}
        </span>

        <span class="hidden-sm hidden-xs">
            - ${{ number_format($cartTotal, 2) }}
        </span>
    </span>

                            </button>

                            <ul class="dropdown-menu header-cart-toggle pull-right">

                                @php
                                    $cart = session('cart', []);
                                @endphp

                                @if(count($cart) > 0)

                                    @foreach($cart as $id => $item)
                                        <li style="display:flex; gap:10px; padding:10px; align-items:center;">

                                            <img src="{{ asset('storage/' . $item['image']) }}"
                                                 style="width:40px; height:40px; object-fit:cover;">

                                            <div>
                                                <div style="font-size:13px;">
                                                    {{ $item['name'] }}
                                                </div>

                                                <div style="font-size:12px; color:#888;">
                                                    {{ $item['quantity'] }} x {{ $item['price'] }}
                                                </div>
                                            </div>

                                        </li>
                                    @endforeach

                                    <li style="text-align:center; padding:10px;">
                                        <a href="{{ route('cart.index') }}" class="btn btn-warning btn-sm">
                                            View Cart
                                        </a>
                                    </li>

                                @else

                                    <li>
                                        <p class="text-center product-cart-empty">
                                            Your shopping cart is empty!
                                        </p>
                                    </li>

                                @endif

                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container">

        <div class="header-bottom">

            <nav id="menu" class="navbar navbar_menu">

                <div class="navbar-header">
                    <button type="button"
                            class="btn btn-navbar navbar-toggle"
                            data-toggle="collapse"
                            data-target="#topCategoryList"
                            id="btnMenuBar">
                        <span class="addcart-icon"></span>
                    </button>
                </div>

                <div id="topCategoryList"
                     class="main-menu menu-navbar clearfix"
                     data-more="More">

                    <div class="menu-close hidden-lg hidden-md">
                        <span id="category">Menu</span>
                        <i class="icon-close"></i>
                    </div>

                    <ul class="nav navbar-nav">

                        <li class="menulist home">
                            <a id="home" href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        @php
                            $locale = app()->getLocale();

                            $getName = function ($category) use ($locale) {
                                return $category->translations
                                    ->firstWhere('locale', $locale)
                                    ?->name
                                    ?? $category->translations->firstWhere('locale', 'az')?->name;
                            };
                        @endphp
                        @foreach($menuCategories as $category)

                            @php
                                $hasChildren = $category->recursiveChildren->count() > 0;
                                $columnClass = $category->recursiveChildren->count() > 3
                                    ? 'column-3'
                                    : 'column-1';
                            @endphp

                            <li class="menulist {{ $hasChildren ? 'dropdown' : '' }}">

                                <a href="{{ route('category.products', $category->id) }}"
                                   class="dropdown-toggle"
                                   data-toggle="dropdown"
                                   onclick="window.location.href=this.href">

                                    {{ $getName($category) }}

                                </a>

                                @if($hasChildren)

                                    <div class="dropdown-menu navcol-menu item-column {{ $columnClass }}">

                                        <div class="dropdown-inner">

                                            @foreach($category->recursiveChildren->chunk(2) as $chunkedSub)

                                                <ul class="list-unstyled childs_1">

                                                    @foreach($chunkedSub as $subCategory)

                                                        @php
                                                            $hasSubChildren = $subCategory->recursiveChildren->count() > 0;
                                                        @endphp

                                                        <li class="{{ $hasSubChildren ? 'dropdown-submenu sub-menu-item' : '' }}">

                                                            <a href="{{ route('category.products', $subCategory->id) }}"
                                                               class="{{ $hasSubChildren ? 'dropdown-toggle' : '' }}"
                                                               onclick="window.location.href=this.href"
                                                               @if($hasSubChildren) data-toggle="dropdown" @endif>

                                                                {{ $getName($subCategory) }}

                                                            </a>

                                                            @if($hasSubChildren)

                                                                <i class="fa fa-angle-right" aria-hidden="true"></i>

                                                                <ul class="list-unstyled sub-menu">

                                                                    @foreach($subCategory->recursiveChildren as $deepCategory)

                                                                        <li>
                                                                            <a href="{{ route('category.products', $deepCategory->id) }}">
                                                                                {{ $getName($deepCategory) }}
                                                                            </a>
                                                                        </li>

                                                                    @endforeach

                                                                </ul>

                                                            @endif

                                                        </li>

                                                    @endforeach

                                                </ul>

                                            @endforeach

                                        </div>

                                    </div>

                                @endif

                            </li>

                        @endforeach
                        <li class="blog">
                            <a href="{{ route('web.contact') }}">
                                Contact
                            </a>
                        </li>

                    </ul>

                </div>

            </nav>

            <div class="customer-support hidden-sm hidden-xs">

                <i class="icon-phone"></i>

                <div class="customer-detail">
                    <span class="call">Customer Support:</span>
                    <span>123-456-7890</span>
                </div>

            </div>

        </div>

    </div>

</header>
