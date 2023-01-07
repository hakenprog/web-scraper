<?php

namespace App\Interfaces;

interface WebScraperFormatter
{
    /**
     * Returns an array of formatted items
     * 
     * @param array $items
     * @return array
     */
    public function formatItems(array $items);
}
