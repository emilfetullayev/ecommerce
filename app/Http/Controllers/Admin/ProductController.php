<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * LIST PAGE
     */
    public function index()
    {
        $products = Product::with(['translations'])
            ->latest()
            ->get();
        $categories = Category::all();


        return view('admin.products.index', compact('products', 'categories'
        ));
    }

    /**
     * STORE PRODUCT
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'translations' => 'required|array',
//            'translations.*.name' => 'required|string',
//            'category_id' => 'required',
//            'retail_price' => 'nullable|numeric',
//            'wholesale_price' => 'nullable|numeric',
//            'images.*' => 'image|mimes:jpg,jpeg,png,webp'
//        ]);

        // 1. PRODUCT CREATE
        $product = Product::create([
            'category_id' => $request->category_id,

            'retail_price' => $request->retail_price,
            'wholesale_price' => $request->wholesale_price,
            'discount_price' => $request->discount_price,
            'code' => $request->code,
            'status' => $request->status ?? 'pending',
            'is_featured' => $request->has('is_featured'),
            'is_discounted' => $request->has('is_discounted'),
        ]);

        // 2. TRANSLATIONS
        foreach ($request->translations as $locale => $data) {

            $product->translations()->create([
                'locale' => $locale,
                'name' => $data['name'] ?? null,
                'description' => $data['description'] ?? null,
            ]);
        }

        // 3. IMAGES
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $file) {

                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('products', $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Product yaradıldı');
    }

    /**
     * EDIT PAGE
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * UPDATE PRODUCT
     */
    public function update(Request $request, Product $product)
    {
        DB::beginTransaction();

        try {

            // 1. PRODUCT UPDATE
            $product->update([
                'category_id' => $request->category_id,
                'retail_price' => $request->retail_price,
                'wholesale_price' => $request->wholesale_price,
                'discount_price' => $request->discount_price,
                'code' => $request->code,
                'status' => $request->status,
                'is_featured' => $request->has('is_featured'),
                'is_discounted' => $request->has('is_discounted'),

            ]);

            // 2. TRANSLATIONS (SAFE REPLACE)
            if ($request->has('translations')) {

                // clean delete
                $product->translations()->delete();

                foreach ($request->translations as $locale => $data) {

                    if (!isset($data['name'])) {
                        continue;
                    }

                    $product->translations()->create([
                        'locale' => $locale,
                        'name' => $data['name'],
                        'description' => $data['description'] ?? null,
                    ]);
                }
            }

            // 3. REMOVE IMAGES
            if ($request->removed_images) {

                $ids = explode(',', $request->removed_images);

                $images = ProductImage::whereIn('id', $ids)->get();

                foreach ($images as $img) {

                    if (Storage::disk('public')->exists($img->image)) {
                        Storage::disk('public')->delete($img->image);
                    }

                    $img->delete();
                }
            }

            // 4. NEW IMAGES
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $file) {

                    $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

                    $path = $file->storeAs('products', $filename, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $path,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('products.index')
                ->with('success', 'Product yeniləndi');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withErrors($e->getMessage());
        }
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return back()->with('success', 'Şəkil silindi');
    }

    /**
     * DELETE PRODUCT
     */
    public
    function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product silindi');
    }
}
