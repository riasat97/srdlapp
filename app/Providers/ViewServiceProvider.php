<?php

namespace App\Providers;
use App\Models\Reference;

use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(['reference_designations.fields'], function ($view) {
            $referenceItems = Reference::pluck('ref_type','id')->toArray();
            $view->with('referenceItems', $referenceItems);
        });
        //
    }
}