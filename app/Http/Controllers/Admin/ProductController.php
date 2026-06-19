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
        $validated = $request->validate([
            'translations.az.name' => 'required|string|max:255',
            'translations.az.description' => 'required|string',

            'translations.en.name' => 'nullable|string|max:255',
            'translations.en.description' => 'nullable|string',

            'translations.ru.name' => 'nullable|string|max:255',
            'translations.ru.description' => 'nullable|string',

            'translations.zh.name' => 'nullable|string|max:255',
            'translations.zh.description' => 'nullable|string',

            'category_id' => 'required|exists:categories,id',
            'retail_price' => 'required|numeric',
            'wholesale_price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',

            'code' => 'required|max:100',
            'is_featured' => 'nullable',
            'is_discounted' => 'nullable',

            'images.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:1024', // 300 KB
                'dimensions:min_width=300,min_height=300,max_width=2000,max_height=2000',
            ],
        ], [
            'translations.az.name.required' => 'Məhsul adı (AZ) mütləqdir.',
            'translations.az.description.required' => 'Məhsul açıqlaması (AZ) mütləqdir.',
            'category_id.required' => 'Kateqoriya seçilməlidir.',
            'category_id.exists' => 'Seçilmiş kateqoriya mövcud deyil.',
            'images.*.image' => 'Fayl şəkil olmalıdır (jpg, jpeg, png, webp).',
            'images.*.dimensions' => 'Şəklin ölçüsü 300x300 - 2000x2000 aralığında olmalıdır.',
            'images.*.max' => 'Şəklin ölçüsü maksimum 1mg ola bilər.',
            'wholesale_price.numeric' => 'Topdansatış qiymət rəqəm olmalıdır.',
            'retail_price.numeric' => 'Retail qiymət rəqəm olmalıdır.',
            'discount_price.numeric' => 'Endirim qiyməti rəqəm olmalıdır.',
            'code.required' => 'Məhsul kodu mütləqdir.',
            'wholesale_price.required' => 'Topdansatış qiymət mütləqdir.',
            'retail_price.required' => 'Perakende qiyməti mütləqdir.',
        ]);

        // PRODUCT
        $product = Product::create([
            'category_id' => $validated['category_id'],
            'retail_price' => $validated['retail_price'] ?? null,
            'wholesale_price' => $validated['wholesale_price'] ?? null,
            'discount_price' => $validated['discount_price'] ?? null,
            'code' => $validated['code'] ?? null,
            'status' => $request->status ?? 'pending',
            'is_featured' => $request->has('is_featured'),
            'is_discounted' => $request->has('is_discounted'),
        ]);

        // TRANSLATIONS (SAFE)
        foreach ($validated['translations'] as $locale => $data) {
            if (!empty($data['name'])) {
                $product->translations()->create([
                    'locale' => $locale,
                    'name' => $data['name'],
                    'description' => $data['description'] ?? null,
                ]);
            }
        }

        // IMAGES (SAFE)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = \Str::random(20) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('products', $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Product uğurla yaradıldı');
    }    /**
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

            // 🔥 VALIDATION (IMPORTANT)
            $validated = $request->validate([
                'translations.az.name' => 'required|string|max:255',
                'translations.az.description' => 'required|string',

                'translations.en.name' => 'nullable|string|max:255',
                'translations.en.description' => 'nullable|string',

                'translations.ru.name' => 'nullable|string|max:255',
                'translations.ru.description' => 'nullable|string',

                'translations.zh.name' => 'nullable|string|max:255',
                'translations.zh.description' => 'nullable|string',

                'category_id' => 'required|exists:categories,id',
                'retail_price' => 'required|numeric',
                'wholesale_price' => 'required|numeric',
                'discount_price' => 'nullable|numeric',

                'code' => 'required|max:100',
                'is_featured' => 'nullable',
                'is_discounted' => 'nullable',

                'images.*' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:1024', // 🔥 300KB
                    'dimensions:min_width=300,min_height=300,max_width=2000,max_height=2000',
                ],
            ], [
                'translations.az.name.required' => 'Məhsul adı (AZ) mütləqdir.',
                'translations.az.description.required' => 'Məhsul açıqlaması (AZ) mütləqdir.',
                'category_id.required' => 'Kateqoriya seçilməlidir.',
                'category_id.exists' => 'Seçilmiş kateqoriya mövcud deyil.',
                'images.*.image' => 'Fayl şəkil olmalıdır (jpg, jpeg, png, webp).',
                'images.*.dimensions' => 'Şəklin ölçüsü 300x300 - 2000x2000 aralığında olmalıdır.',
                'images.*.max' => 'Şəklin ölçüsü maksimum 1mg ola bilər.',
                'wholesale_price.numeric' => 'Topdansatış qiymət rəqəm olmalıdır.',
                'retail_price.numeric' => 'Retail qiymət rəqəm olmalıdır.',
                'discount_price.numeric' => 'Endirim qiyməti rəqəm olmalıdır.',
                'code.required' => 'Məhsul kodu mütləqdir.',
                'wholesale_price.required' => 'Topdansatış qiymət mütləqdir.',
                'retail_price.required' => 'Perakende qiyməti mütləqdir.',
            ]);

            // 1. PRODUCT UPDATE
            $product->update([
                'category_id' => $validated['category_id'],
                'retail_price' => $validated['retail_price'],
                'wholesale_price' => $validated['wholesale_price'],
                'discount_price' => $validated['discount_price'] ?? null,
                'code' => $validated['code'],
                'status' => $request->status ?? 'pending',
                'is_featured' => $request->has('is_featured'),
                'is_discounted' => $request->has('is_discounted'),
            ]);

            // 2. TRANSLATIONS (SAFE REPLACE)
            $product->translations()->delete();

            foreach ($validated['translations'] as $locale => $data) {

                if (!empty($data['name'])) {
                    $product->translations()->create([
                        'locale' => $locale,
                        'name' => $data['name'],
                        'description' => $data['description'] ?? null,
                    ]);
                }
            }

            // 3. REMOVE IMAGES
            if ($request->filled('removed_images')) {

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

            return back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return response()->json([
            'success' => true,
        ]);    }

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
