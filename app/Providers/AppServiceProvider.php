<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, "pt_BR.utf-8",'pt-BR');
        date_default_timezone_set('Europe/Lisbon');
        Schema::defaultStringLength(191);



        // setlocale(LC_TIME, "pt_BR.utf-8",'pt-BR');
        // // setlocale(LC_TIME, "pt_BR.utf-8",'pt-BR');
        // Schema::defaultStringLength(191);
      
        // Carbon::setLocale('pt_BR.utf8');
        // Carbon::setUtf8(true);
       
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
