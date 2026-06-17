<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    public function index(Request $request) {
// 1. Featured Products
        $featuredProducts = Product::with([
            'images',
            'translations' => function ($q) {
                $q->where('locale', app()->getLocale());
            }
        ])->where('is_featured', 1)->latest()->get();

// 2. Discounted Products
        $discounted = Product::with([
            'images',
            'translations' => function ($q) {
                $q->where('locale', app()->getLocale());
            }
        ])->where('is_discounted', 1)->latest()->get();

// 3. Adi Məhsullar (Bazada nə qədər varsa, hər dəfə 9-9 gətirəcək)
        $products = Product::with([
            'images',
            'translations' => function ($q) {
                $q->where('locale', app()->getLocale());
            }
        ])->where('is_discounted', 0)->latest()->paginate(6);

// --- KRİTİK HİSSƏ: Əgər AJAX sorğusudursa (Səhifə aşağı sürüşdürülübsə) ---
        if ($request->ajax()) {
            $html = '';
            foreach ($products as $data) {
                $translation = $data->translations->where('locale', app()->getLocale())->first()
                    ?? $data->translations->where('locale', 'az')->first();

                $name = $translation->name ?? $data->name;
                $price = $data->retail_price;

                if (auth()->guard('company')->check() && auth()->guard('company')->user()->price_type === 'wholesale') {
                    $price = $data->wholesale_price;
                }

                $img = optional($data->images->first())->image;
                $imgSrc = $img ? asset('storage/'.$img) : asset('web/image/no-image.png');
                $categoryName = $data->category?->translations->firstWhere('locale', app()->getLocale())?->name
                    ?? $data->category?->translations->firstWhere('locale', 'az')?->name;
                $productCode = $data->code ?? '';
                $formattedPrice = number_format($price, 2);
                $productUrl = route('web.product.show', $data->id);
                $loginUrl = route('company.login');

                $cartButton = auth()->guard('company')->check()
                    ? '<button type="button" class="btn-cart grainger-btn-cart">Sepete ekle</button>'
                    : '<button type="button" onclick="window.location.href=\''.$loginUrl.'\'" class="btn-login">Sepete ekle</button>';

// Hər bir məhsul üçün təmiz HTML string formalaşdırırıq
                $html .= '
<div class="col-xs-12 col-sm-6 col-md-3 product-layout">
    <div class="grainger-product-card style-ad-card" data-product-id="'.$data->id.'">
        <div class="ad-image-box">
            <a href="'.$productUrl.'">
                <img src="'.$imgSrc.'" class="img-responsive" alt="'.$name.'">
            </a>
            <div class="ad-heart-badge"><i class="fa fa-heart-o"></i></div>
        </div>
        <div class="grainger-info-wrapper">
            <div class="grainger-top-meta">
                <span class="grainger-brand">'.$categoryName.'</span>
                <h4 class="grainger-title"><a href="'.$productUrl.'">'.$name.'</a></h4>
                <div class="grainger-sku">Məhsul kodu '.$productCode.'</div>
            </div>
            <div class="grainger-price-block">
                <span class="price-label">Qiyməti</span>
                <div class="price-row">
                    <span class="price-amount">'.$formattedPrice.' ₼</span>
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
                '.$cartButton.'
            </div>
        </div>
    </div>
</div>';
            }

// Formallaşmış HTML-i birbaşa AJAX-a cavab olaraq qaytarırıq (Heç bir render xətası olmur)
            return response()->json(['html' => $html, 'hasMore' => $products->hasMorePages()]);
        }

        return view('site.home.index', compact('featuredProducts', 'products', 'discounted'));
    }


    public function show($id)
    {
        $product = Product::with('images',)->findOrFail($id);


        $relatedProducts = Product::with('images')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(8)
            ->get();

        return view('site.home.show', compact('product', 'relatedProducts'));
    }



}
