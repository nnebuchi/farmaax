<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        //
        $farmManagers = User::where('farm_manager', 'yes')->count();
        $lawyer = User::where('lawyer', 'yes')->count();
        $marketer = User::where('marketer', 'yes')->count();
        $realtors = User::where('realtor', 'yes')->count();
        view()->share(['farmManagers' => $farmManagers, 'lawyers' => $lawyer, 'marketers' => $marketer, 'realtors' => $realtors]);
        Schema::defaultStringLength(191);
    }
}
