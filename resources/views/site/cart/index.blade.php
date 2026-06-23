@extends('site.layouts.app')


@section('content')
    <div id="product-page" class="container">

        @include('site.partials.breadcrumb')

        <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
            <h2>{{ t('cart_title') }}</h2>
            <hr>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(count($cart) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" style="vertical-align: middle; text-align: center;">
                        <thead>
                        <tr style="background: #f9f9f9;">
                            <th>{{ t('cart_image') }}</th>
                            <th>{{ t('cart_product_name') }}</th>
                            <th>{{ t('cart_price') }}</th>
                            <th>{{ t('cart_quantity') }}</th>
                            <th>{{ t('cart_total') }}</th>
                            <th>{{ t('cart_actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart as $id => $details)
                            <tr>
                                <td style="width: 100px;">
                                    @if($details['image'])
                                        <img src="{{ asset('storage/' . $details['image']) }}" width="80"
                                             style="object-fit: contain;">
                                    @else
                                        <img src="{{ asset('web/image/no-image.png') }}" width="80">
                                    @endif
                                </td>

                                <td style="text-align: left; vertical-align: middle;">
                                    <strong>{{ $details['name'] }}</strong>
                                </td>

                                <td style="vertical-align: middle;">
                                    {{ number_format($details['price'], 2) }}
                                </td>

                                <td style="vertical-align: middle; width: 120px;">
                                    <input type="number" value="{{ $details['quantity'] }}"
                                           class="form-control text-center" min="1" disabled>
                                </td>

                                <td style="vertical-align: middle;">
                                    {{ number_format($details['price'] * $details['quantity'], 2) }}
                                </td>

                                <td style="vertical-align: middle;">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST"
                                          onsubmit="return confirm('Silmək istədiyinizdən əminsiniz?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Sil
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-4 col-sm-offset-8" style="text-align: right;">
                        <div class="well" style="background: #f5f5f5; padding: 20px; border-radius: 6px;">
                            <h3>Yekun: <span style="color: #ffbc00;">{{ number_format($totalPrice, 2) }}</span></h3>
                            <hr>
                            <a href="{{ route('cart.complete') }}"
                               class="btn btn-primary btn-lg btn-block"
                               style="background:#333;border:none; color: #fff;">
                                Sifarişi Tamamla
                            </a></div>
                    </div>
                </div>
            @else
                <div class="text-center" style="padding: 50px 0;">
                    <i class="icon-bag" style="font-size: 64px; color: #ccc; display: block; margin-bottom: 20px;"></i>
                    <p style="font-size: 18px; color: #666;">{{ t('cart_empty_message') }}</p>
                    <a href="{{ route('web.product') }}" class="btn btn-warning"
                       style="background: #ffbc00; color: #000; border: none; font-weight: 600;">   {{ t('continue_shopping') }}</a>
                </div>
            @endif
        </div>
    </div>
@endsection
