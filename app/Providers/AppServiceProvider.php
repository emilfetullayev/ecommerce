<?php

namespace App\Providers;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            $menuCategories = Category::with([
                'translations',
                'recursiveChildren.translations'
            ])
                ->where(function($query) {
                    $query->whereNull('parent_id')
                        ->orWhere('parent_id', 0);
                })
                ->get();

            $view->with('menuCategories', $menuCategories);
        });
    }
}
