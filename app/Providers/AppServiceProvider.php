<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Actions\ProductSkuAction;
use TCG\Voyager\Facades\Voyager;

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
      Voyager::addAction(ProductSkuAction::class);
    }
}
