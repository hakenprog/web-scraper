<?php

namespace App\Services;

use App\Interfaces\WebScraperFormatter;

class NewsYCombinatorScraperFormatter implements WebScraperFormatter
{
    private $columnNames = ['rank', 'title', 'points', 'comments'];

    /**
     *  Return an array of formatted items for the News Y Combinator Web scraper.
     * @param array $items
     * @return array 
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

    /**
     * Returns the given array without the 'prev'index with the new row at the end.
     * @param array $prevState
     * @return array
     */
    private function pushRow(array $prevState)
    {
        $prevItem = [...$prevState];
        $row = $prevItem['prev'];
        unset($prevItem['prev']);
        return [...$prevItem, $this->fillRowEmptyValues($row)];
    }

    /**
     * Returns the column name based on the current column index.
     * @param string $item
     * @param int $currentRowColumn
     * @return string
     */
    private function getCurrentColumnType(string $item, int $currentRowColumn)
    {
        if ($currentRowColumn <= 1) return $this->columnNames[$currentRowColumn];
        if ($this->isPoints($item)) return 'points';
        return  'comments';
    }

    /**
     * Returns the column index based on the size of given array.
     * @param array $prevItem
     * @return int
     */
    private function getCurrentRowColumnIndex(array $prevItem)
    {
        return key_exists('prev', $prevItem) ? sizeof($prevItem['prev']) : 0;
    }

    /**
     * Returns a number included in the given string or 0 if the column is not the title.
     * @param int $rowIndex
     * @param string $rowItem
     * @return int|string
     */
    private function formatRowItem(int $rowIndex, string $rowItem)
    {
        if ($rowIndex !== 1) return $this->extractNumberFromString($rowItem);
        return $rowItem;
    }

    /**
     * Returns true if the given string contains the word "points".
     * @param string $item
     * @return bool
     */
    private function isPoints(string $item)
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
     * @param string $item
     * @return int
     */
    private function extractNumberFromString(string $item)
    {
        $extractedNumber = intval(preg_replace('/\D/', '', $item));
        return empty($extractedNumber) ? 0 : $extractedNumber;
    }
}
