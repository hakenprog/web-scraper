<?php

namespace App\Interfaces;

interface WebScraper
{
    /**
     * Returns the result of the scraper
     * 
     * @return array
     */
    public function getItems();
}
