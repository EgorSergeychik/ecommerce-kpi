<?php

namespace App\Providers;

use DB;
use Event;
use Illuminate\Support\ServiceProvider;
use Laravel\Octane\Events\WorkerStopping;
use Laravel\Passport\Passport;
use Log;

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
        Passport::enablePasswordGrant();

        Event::listen(WorkerStopping::class, function () {
            Log::info('SIGTERM received. Starting graceful shutdown...');
            DB::disconnect();
        });
    }
}
