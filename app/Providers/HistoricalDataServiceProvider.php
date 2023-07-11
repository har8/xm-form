<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\HistoricalDataServiceInterface;
use App\Services\HistoricalDataService;

class HistoricalDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
		//$this->app->bind(SMSProvider::class, TelnyxSMSProvider::class);
		$this->app->bind(HistoricalDataServiceInterface::class, function () {
          return new HistoricalDataService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
