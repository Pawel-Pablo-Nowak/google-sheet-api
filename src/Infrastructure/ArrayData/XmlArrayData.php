<?php

declare(strict_types=1);

namespace App\Infrastructure\ArrayData;

use App\Domain\ArrayData\ArrayData;

class XmlArrayData implements ArrayData
{
    public static function serveArrayData(string $filePath): array
    {
        try {
            $xml = simplexml_load_file($filePath);
        } catch (\Exception $e) {
            return [];
        }

        $xmlData = [];
        $xmlData[] = self::getHeaderFromXml($xml);
        $xmlData = self::getValues($xml, $xmlData);

        return $xmlData;
    }

    public static function getHeaderFromXml($xml): array
    {
        $header = [];

        foreach ($xml->item->children() as $field) {
            $header[] = $field->getName();
        }

        return $header;
    }

    protected static function getValues($xml, $xmlData): array
    {
        foreach ($xml->children() as $n) {
            $rowData = [];
            foreach ($n->children() as $field) {
                $rowData[] = (string) $field;
            }
            $xmlData[] = $rowData;
        }

        return $xmlData;
    }
}
