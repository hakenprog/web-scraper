<?php

namespace App\Services;

use App\Interfaces\WebScraperFormatter;

class NewsYCombinatorScraperFormatter implements WebScraperFormatter
{
    private $columnNames = ['rank', 'title', 'points', 'comments'];

    /**
     *  Return an array of formatted items for the News Y Combinator Web scraper.
     * @param array $items
     */
    public function formatItems(array $items)
    {
        return array_reduce(
            $items,
            function ($prev, $current) {
                $prevState = [...$prev];
                if (empty($current)) return $this->pushRow($prevState);
                $currentRowColumnIndex = $this->getCurrentRowColumnIndex($prevState);
                $formattedRowItem = $this->formatRowItem($currentRowColumnIndex, $current);
                $prevState['prev'][$this->getCurrentColumnType($current, $currentRowColumnIndex)] = $formattedRowItem;
                return $prevState;
            },
            []
        );
    }

    private function pushRow(array $prevState)
    {
        $prevItem = [...$prevState];
        $row = $prevItem['prev'];
        unset($prevItem['prev']);
        return [...$prevItem, $this->fillRowEmptyValues($row)];
    }

    private function getCurrentColumnType($item, $currentRowColumn)
    {
        if ($currentRowColumn <= 1) return $this->columnNames[$currentRowColumn];
        if ($this->isPoints($item)) return 'points';
        return  'comments';
    }

    private function getCurrentRowColumnIndex(array $prevItem)
    {
        return key_exists('prev', $prevItem) ? sizeof($prevItem['prev']) : 0;
    }

    private function formatRowItem($rowIndex, $rowItem)
    {
        if ($rowIndex !== 1) return $this->extractNumberFromString($rowItem);
        return $rowItem;
    }

    private function isPoints($item)
    {
        return str_contains($item, 'points');
    }

    /**
     * Adds the missing columns in the row with a default value (0) if there is one.
     * @param array $formattedItem
     * @return array
     */
    private function fillRowEmptyValues(array $formattedItem)
    {
        if (sizeof($formattedItem) === 4) return $formattedItem;
        $missingColumns = array_diff($this->columnNames, array_keys($formattedItem));
        return [...$formattedItem, ...array_fill_keys($missingColumns, 0)];
    }


    /**
     * Extracts a number of a string if exists, otherwise returns 0.
     * @param string $str
     * @return int
     */
    private function extractNumberFromString(string $string)
    {
        $extractedNumber = intval(preg_replace('/\D/', '', $string));
        return empty($extractedNumber) ? 0 : $extractedNumber;
    }
}
