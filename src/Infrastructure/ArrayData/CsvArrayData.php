<?php

declare(strict_types=1);

namespace App\Infrastructure\ArrayData;

use App\Domain\ArrayData\ArrayData;

class CsvArrayData implements ArrayData
{
    public static function serveArrayData(string $filePath): array
    {
        if (file_exists($filePath)) {
            return array_map('str_getcsv', file($filePath));
        }

        return [];
    }
}
