<?php

namespace App\Interfaces;

interface WebScraperErrorManager
{
    /**
     * Executes the we scraper inside a try catch
     * 
     * @param callable $webscraperCallback
     * @return array
     */
    public function scrapWrapper($webscraperCallback);
}