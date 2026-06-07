<nav id="top">
    <div class="container">
        <div class="top-left">
            <div class="free-delivery hidden-sm hidden-xs">
                <span>Free Delivery:</span> <span>Take advantage of our time to save event</span>
            </div>
        </div>
        <div class="top-right">
            <div id="header_ac" class="dropdown">
                <a href="#" title="My Account" class="dropdown-toggle" data-toggle="dropdown">
                    @if(Auth::guard('company')->check())
                        <i class="fa fa-building-o"></i>
                        <span>{{ Auth::guard('company')->user()->company_name }}</span>
                    @else
                        <i class="fa fa-user-o"></i>
                        <span>My Account</span>
                    @endif

                    <i class="fa fa-angle-down"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right account-link-toggle">
                    @guest('company')
                        <li>
                            <a href="{{ route('company.login') }}">
                                <i class="fa fa-user-plus"></i> Login / Register
                            </a>
                        </li>
                    @endguest


                    @auth('company')
                        <li>
                            <a href="{{ route('cart.index') }}">
                                <i class="fa fa-shopping-cart"></i> Səbətim
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="{{ route('company.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('company-logout-form').submit();"
                               style="color: #d9534f;">
                                <i class="fa fa-sign-out"></i> Çıxış et
                            </a>

                            <form id="company-logout-form"
                                  action="{{ route('company.logout') }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
            @php
                // Cari aktiv dili və onun görünəcək adını təyin edirik
                $currentLocale = app()->getLocale();

                $locales = [
                    'az' => ['name' => 'Azərbaycan', 'flag' => 'az.png', 'code' => 'AZ'],
                    'en' => ['name' => 'English',    'flag' => 'en.png', 'code' => 'EN'],
                    'ru' => ['name' => 'Русский',    'flag' => 'ru.png', 'code' => 'RU'],
                    'zh' => ['name' => '中国',    'flag' => 'zh.png', 'code' => 'ZH'],

                ];

                // Əgər sistemdə naməlum dil gələrsə, standart olaraq az göstərsin
                $currentLang = $locales[$currentLocale] ?? $locales['az'];
            @endphp

            <div class="language">
                <div class="pull-left">
                    <div class="btn-group">
                        {{-- Aktiv Dil Düyməsi --}}
                        <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <span class="drop-text">Language</span>
                            <span class="code">{{ $currentLang['code'] }}</span>
                            <i class="fa fa-angle-down"></i>
                        </button>

                        {{-- Dil Siyahısı Açılan Menyu --}}
                        <ul class="dropdown-menu language-dropdown lang">
                            @foreach($locales as $code => $lang)
                                {{-- Cari seçili dili siyahıda təkrar göstərməmək üçün (istəsəniz silə bilərsiniz) --}}
                                @if($code !== $currentLocale)
                                    <li>
                                        <a href="{{ route('lang.switch', $code) }}"
                                           class="btn btn-link btn-block language-select"
                                           style="text-align: left; display: block; padding: 5px 15px; color: #333; text-decoration: none;">
                                            {{ $lang['name'] }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
