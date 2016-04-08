<?php

namespace App\Providers;

use DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	$data = DB::select("SELECT EXTRACT(YEAR FROM created_at) AS dates FROM `situations` WHERE `roles` IS NOT NULL GROUP BY dates ORDER BY dates DESC");
        view()->share('years', $data);
        
        $express = DB::select("SELECT EXTRACT(YEAR FROM created_at) AS dates FROM `situations` WHERE `roles` IS NULL GROUP BY dates ORDER BY dates DESC");
        view()->share('expresses', $express);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
