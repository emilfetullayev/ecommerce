<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with([
            'translations',
            'children.translations',
            'children.recursiveChildren.translations'
        ])
            ->whereNull('parent_id')
            ->get();

        $allCategories = Category::with('translations')->get();

        return view('admin.categories.index', compact(
            'categories',
            'allCategories'
        ));
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'parent_id' => $request->parent_id,
        ]);

        foreach ($request->translations as $locale => $data) {
            $category->translations()->create([
                'locale' => $locale,
                'name' => $data['name'],
            ]);
        }

        return back();
    }

    public function edit(Category $category)
    {
        $category->load('translations');

        $allCategories = Category::where('id', '!=', $category->id)->get();

        return view('admin.categories.edit', compact(
            'category',
            'allCategories'
        ));
    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'parent_id' => $request->parent_id,
        ]);

        foreach ($request->translations as $locale => $data) {

            $category->translations()->updateOrCreate(
                ['locale' => $locale],
                ['name' => $data['name']]
            );
        }

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->translations()->delete();
        $category->delete();

        return back();
    }

}
