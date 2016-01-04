<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MacrosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach(glob(base_path('resources/macros/*.macros.php')) as $filename)
            { 
                require_once($filename); 
            }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
