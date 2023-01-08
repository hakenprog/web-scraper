<?php

namespace App\Services;

use App\Interfaces\WebScraperErrorHandler;
use InvalidArgumentException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class NewsYCombinatorScraperErrorHandler implements WebScraperErrorHandler
{
    public function scrapWrapper($webscraperCallback)
    {
        try {
            // execute the web scrap function
            return call_user_func($webscraperCallback);
        } catch (InvalidArgumentException | TransportExceptionInterface  $exception) {
            // return an empty array if tehere are any problem during the scraping
            return [];
        }
    }
}
