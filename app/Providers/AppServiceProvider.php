<?php

namespace App\Providers;

use App\Models\CityModel;
use App\Models\MainMenuModel;
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
        $category = MainMenuModel::select('id', 'slug', 'name')
            ->whereNotNull('slug')->where('status', '1')
            ->get();
        view()->share([
            'category' => $category
        ]);
    }
}
