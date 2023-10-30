<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard/user';
    public const HOMEADMIN='admin/dashboard';
    public const HOMEDOCTOR='/doctor/dashboard';
    public const HOMERAY='/rayemployee/dashboard';
    public const HOMELAB='/labemployee/dashboard';
    public const HOMEPATION='/pation/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
                Route::middleware('web')
               ->group(base_path('routes/admin.php'));
               Route::middleware('web')
               ->group(base_path('routes/doctor.php'));
               Route::middleware('web')
               ->group(base_path('routes/rayemployee.php'));
               Route::middleware('web')
               ->group(base_path('routes/labemployee.php'));
               Route::middleware('web')
               ->group(base_path('routes/pation.php'));
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
