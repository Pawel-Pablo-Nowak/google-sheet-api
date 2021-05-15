<?php

declare(strict_types=1);

namespace App\Domain\ArrayData;

interface ArrayData
{
    public static function serveArrayData(string $filePath): array;
}
