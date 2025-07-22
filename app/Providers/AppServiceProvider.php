<?php

namespace App\Providers;

use App\Models\Item;
use App\PaymentGatewayInterface;
use App\Policies\ItemPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    protected $policies = [
        Item::class => ItemPolicy::class,
    ];

    public function register(): void
    {
        // $this->app->bind(PaymentGatewayInterface::class,)
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
