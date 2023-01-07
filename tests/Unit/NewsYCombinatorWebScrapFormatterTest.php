<?php

namespace Tests\Unit;

use App\Interfaces\WebScraperFormatter;
use PHPUnit\Framework\TestCase;

class NewsYCombinatorWebScrapFormatter extends TestCase
{
    /**
     * A unit test for the NewsYCombinator Webscrapper formatter.
     *
     * @dataProvider Tests\DataProviders\NewsYCombinatorDataProvider::standard_data_provider
     * @dataProvider Tests\DataProviders\NewsYCombinatorDataProvider::missing_points_invalid_comments_data_provider
     * @dataProvider Tests\DataProviders\NewsYCombinatorDataProvider::invalid_comments_data_provider
     * @dataProvider Tests\DataProviders\NewsYCombinatorDataProvider::missing_points_data_provider
     * @dataProvider Tests\DataProviders\NewsYCombinatorDataProvider::missing_comments_data_provider

     * @return void
     */
    public function test_new_y_combinator_formatter_standar(array $data)
    {
        $formatter = new NewsYCombinatorWebScrapFormatter();
        $formattedItems = $formatter->formatItems($data[0]);
        $this->assertIsArray($formattedItems);
        $this->assertEqualsCanonicalizing($formattedItems, $data[1]);
        $this->assertTrue(true);
    }

}
