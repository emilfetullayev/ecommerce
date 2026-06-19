<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with([
            'images',
            'translations' => function ($q) {
                $q->where('locale', app()->getLocale());
            }
        ])->where('is_discounted', 0)->latest()->paginate(6);

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
                $imgSrc = $img ? asset('storage/' . $img) : asset('web/image/no-image.png');
                $categoryName = $data->category?->translations->firstWhere('locale', app()->getLocale())?->name
                    ?? $data->category?->translations->firstWhere('locale', 'az')?->name;
                $productCode = $data->code ?? '';
                $formattedPrice = number_format($price, 2);
                $productUrl = route('web.product.show', $data->id);
                $loginUrl = route('company.login');

                $cartButton = auth()->guard('company')->check()
                    ? '<button type="button" class="btn-cart grainger-btn-cart">Sepete ekle</button>'
                    : '<button type="button" onclick="window.location.href=\'' . $loginUrl . '\'" class="btn-login">Sepete ekle</button>';

                $html .= '
<div class="col-xs-12 col-sm-6 col-md-3 product-layout">
    <div class="grainger-product-card style-ad-card" data-product-id="' . $data->id . '">
        <div class="ad-image-box">
            <a href="' . $productUrl . '">
                <img src="' . $imgSrc . '" class="img-responsive" alt="' . $name . '">
            </a>
            <div class="ad-heart-badge"><i class="fa fa-heart-o"></i></div>
        </div>
        <div class="grainger-info-wrapper">
            <div class="grainger-top-meta">
                <span class="grainger-brand">' . $categoryName . '</span>
                <h4 class="grainger-title"><a href="' . $productUrl . '">' . $name . '</a></h4>
                <div class="grainger-sku">Məhsul kodu ' . $productCode . '</div>
            </div>
            <div class="grainger-price-block">
                <span class="price-label">Qiyməti</span>
                <div class="price-row">
                    <span class="price-amount">' . $formattedPrice . ' ₼</span>
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
                ' . $cartButton . '
            </div>
        </div>
    </div>
</div>';
            }

            return response()->json(['html' => $html, 'hasMore' => $products->hasMorePages()]);
        }

        return view('site.product.index', compact('products'));
    }


    public function byCategory($id)
    {
        $category = Category::findOrFail($id);

        $categoryIds = Category::where('id', $id)
            ->orWhere('parent_id', $id)
            ->pluck('id')
            ->toArray();

        $products = Product::with([
            'images',
            'translations' => function ($q) {
                $q->where('locale', 'az');
            }
        ])
            ->whereIn('category_id', $categoryIds)
            ->latest()
            ->paginate(2);
        return view('site.product.index', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $query = Product::with([
            'images',
            'translations' => function ($q) {
                $q->where('locale', 'az');
            }
        ]);

        if ($request->search) {
            $search = $request->search;

            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($request->category_id && $request->category_id != 0) {

            $categoryIds = Category::where('id', $request->category_id)
                ->orWhere('parent_id', $request->category_id)
                ->pluck('id');

            $query->whereIn('category_id', $categoryIds);
        }

        $products = $query->latest()->paginate(2);

        return view('site.product.index', compact('products'));
    }
}
