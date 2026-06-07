<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'images',
            'translations' => function ($q) {
                $q->where('locale', 'az');
            }
        ])
            ->latest()
            ->paginate(2);

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
