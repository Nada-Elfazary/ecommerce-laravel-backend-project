<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $namespaceApi = 'App\\Http\\Controllers\\Api';
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
        // After that update the boot function.
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespaceApi)
            ->group(base_path('routes/api.php'));
    }
}
