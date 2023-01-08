<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsYCombinatorWebScraping extends TestCase
{
    private $apiResponse;



    protected function setUp(): void
    {
        parent::setUp();
        $this->apiResponse = $this->json('GET', '/api/v1/newsycombinator');
    }

    /**
     * Ensure the web scraper api works.
     *
     * @return void
     */
    public function test_api_works()
    {
        $this->apiResponse->assertStatus(200);
    }

    /**
     * Ensure the web scraper api works and returns a valid json.
     *
     * @return void
     * @depends test_api_works
     */
    public function test_api_returns_correct_format()
    {
        $content = json_decode($this->apiResponse->getContent(), true);
        $this->assertIsArray($content);
    }
}
