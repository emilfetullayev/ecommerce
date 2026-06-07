<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    public function index(){
        $featuredProducts = Product::with([
            'images',
            'translations' => function ($q) {
                $q->where('locale', app()->getLocale());
            }
        ])
            ->where('is_featured', 1)
            ->latest()
            ->get();

        $products = Product::with([
            'images',
            'translations' => function ($q) {
                $q->where('locale', app()->getLocale());
            }
        ])
            ->where('is_discounted', 0)

            ->latest()
            ->get();

        $discounted = Product::with([
            'images',
            'translations' => function ($q) {
                $q->where('locale', app()->getLocale());
            }
        ])
            ->where('is_discounted', 1)
            ->latest()
            ->get();
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
