<?php

namespace App\Services;

use App\Interfaces\WebScraperErrorManager;
use InvalidArgumentException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class NewsYCombinatorScraperErrorManager implements WebScraperErrorManager
{
    public function scrapWrapper($webscraperCallback)
    {
        try {
            // execute the web scrap function
            return call_user_func($webscraperCallback);
        } catch (InvalidArgumentException | TransportExceptionInterface  $exception) {
            // return an empty array if tehere are aby problem during the scraping
            return [];
        }
    }
}
