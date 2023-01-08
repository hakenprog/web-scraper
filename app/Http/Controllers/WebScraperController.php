<?php

namespace App\Http\Controllers;

use App\Interfaces\WebScraper;

/**
 * Base class for web scraper controllers.
 * 
 * By default this class has a variable called $webscraper. Any
 * class that implements de WebScraper interface can be received in the constructor.
 * You can use this variable to show the items returned by the web scraper.
 * 
 * @see App\Interfaces\WebScraper
 */
class WebScraperController extends Controller
{
    /** @var WebScraper $webScraper */
    private $webScraper;

    public function __construct(WebScraper $webScraper)
    {
        $this->webScraper = $webScraper;
    }
    /**
     * Executes the web scraping and returns the result.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = $this->webScraper->getItems();
        $status = empty($result) ?  503 : 200;
        return response()->json($result, $status);
    }
}
