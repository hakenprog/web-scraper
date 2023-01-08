<?php

namespace App\Interfaces;

interface WebScraperErrorHandler
{
    /**
     * Executes the we scraper inside a try catch block.
     * 
     * @param callable $webscraperCallback
     * @return array
     */
    public function scrapWrapper($webscraperCallback);
}