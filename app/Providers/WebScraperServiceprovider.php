<?php

namespace App\Providers;

use App\Interfaces\WebScraper;
use App\Interfaces\WebScraperErrorHandler;
use App\Interfaces\WebScraperFormatter;
use App\Services\NewsYCombinatorScraperErrorHandler;
use App\Services\NewsYCombinatorScraperFormatter;
use App\WebScrapers\NewsYCombinatorScraper;
use Illuminate\Support\ServiceProvider;

class WebScraperServiceprovider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WebScraperFormatter::class, NewsYCombinatorScraperFormatter::class);
        $this->app->bind(WebScraper::class, NewsYCombinatorScraper::class);
        $this->app->bind(WebScraperErrorHandler::class, NewsYCombinatorScraperErrorHandler::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
