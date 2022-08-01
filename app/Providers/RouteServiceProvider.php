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
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::prefix('financial')
                ->as('financial.')
                ->middleware('web')
                ->namespace('App\Http\Controllers\Financial')
                ->group(base_path('routes/financial.php'));

            Route::prefix('student')
                ->as('student.')
                ->middleware('web')
                ->namespace('App\Http\Controllers\Student')
                ->group(base_path('routes/student.php'));

            Route::prefix('parent')
                ->as('parent.')
                ->middleware('web')
                ->namespace('App\Http\Controllers\StudentParent')
                ->group(base_path('routes/parent.php'));

            Route::prefix('instructor')
                ->as('instructor.')
                ->middleware('web')
                ->namespace('App\Http\Controllers\Instructor')
                ->group(base_path('routes/instructor.php'));

            Route::prefix('admin')
                ->as('admin.')
                ->middleware('web')
                ->namespace('App\Http\Controllers\Admin')
                ->group(base_path('routes/admin.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
