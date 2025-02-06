<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    public const HOME = '/home';
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->routes(function () {
            // Carga de rutas para API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Carga de rutas para web
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        $lenguaje = Session::get('lenguaje', config('app.locale'));
        App::setLocale($lenguaje);
    }
}
