<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Actions\ProductSkuAction;
use TCG\Voyager\Facades\Voyager;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer(['components.header'], function ($toView){
        $categories = Category::where('status',1)->orderBy('order', 'asc')->get();
        $toView->with('categories', $categories);
      });

      Voyager::addAction(ProductSkuAction::class);
    }
}
