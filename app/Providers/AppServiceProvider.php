<?php

namespace App\Providers;

use App\Modules\Notifications\Contracts\NotificationSender;
use App\Modules\Notifications\Services\BrevoNotificationSender;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NotificationSender::class, BrevoNotificationSender::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
