<?php

namespace Tests\Unit;

use App\Interfaces\WebScraperFormatter;

use PHPUnit\Framework\TestCase;

class NewsYCombinatorWebScrapFormatter extends TestCase
{
    /**
     * A unit test for the NewsYCombinator Webscrapper formatter.
     *
     * @dataProvider news_y_combinator_formatter
     * 
     * @return void
     */
    public function test_new_y_combinator_formatter(WebScraperFormatter $formatter, array $valuesTotest)
    {
        $formattedItems = $formatter->formatItems($valuesTotest);
        $this->assertIsArray($formattedItems);
        $this->assertEqualsCanonicalizing($formattedItems, NewsYCombinatorFormatterExpectedData);
        $this->assertTrue(true);
    }

    public function news_y_combinator_formatter()
    {
        return [
            new NewsYCombinatorWebScraperFormatter(),
            NewsYCombinatorFormatterDataProvider
        ];
    }
}
