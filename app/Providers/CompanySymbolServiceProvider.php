<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CompanySymbolServiceInterface;
use App\Services\CompanySymbolService;

class CompanySymbolServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
		$this->app->bind(CompanySymbolServiceInterface::class, function () {
          return new CompanySymbolService();
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
