<?php

namespace App\Providers;

use App\ExternalAPI\Coin;
use App\ExternalAPI\CoinPaprika;
use Illuminate\Support\ServiceProvider;

class CoinProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Coin::class, CoinPaprika::class);
    }
}
