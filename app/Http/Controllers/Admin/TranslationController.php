<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use Illuminate\Http\Request;


class TranslationController extends Controller
{
    public function index()
    {
        $translations = Translation::all()
            ->groupBy(['group', 'key']);

        return view('admin.translations.index', compact('translations'));
    }

    public function store(Request $request)
    {
        foreach (['az', 'en', 'ru'] as $locale) {
            Translation::updateOrCreate(
                [
                    'group' => $request->group,
                    'key' => $request->key,
                    'locale' => $locale,
                ],
                [
                    'value' => $request->get("value_$locale")
                ]
            );
        }

        return back();
    }

    public function edit($group, $key)
    {
        $translations = Translation::where('group', $group)
            ->where('key', $key)
            ->get()
            ->keyBy('locale');

        return view('admin.translations.edit', compact('translations', 'group', 'key'));
    }

    public function update(Request $request, $group, $key)
    {
        foreach (['az', 'en', 'ru'] as $locale) {
            Translation::updateOrCreate(
                [
                    'group' => $group,
                    'key' => $key,
                    'locale' => $locale,
                ],
                [
                    'value' => $request->get("value_$locale")
                ]
            );
        }

        return redirect()->route('admin.translations.index');
    }

    public function destroy($group, $key)
    {
        Translation::where('group', $group)
            ->where('key', $key)
            ->delete();

        return back();
    }
}
