<?php
declare(strict_types=1);

namespace App\Tests\Infrastructure;

use App\Infrastructure\ArrayData\CsvArrayData;
use PHPUnit\Framework\TestCase;

class CsvArrayDataTest extends TestCase
{
    public function testCsvServe() 
    {
        
       $this->assertEquals(
           [
                ['sample','sample1'],
                ['data1','data7'],
                ['data2','data8'],
                ['data3','data9'],
                ['data4','data10'],
                ['data5','data11'],
                ['data6','data12']
           ], 
           CsvArrayData::serveArrayData('./public/test.csv')
       );
    }

    public function testEmptyCsvServe()
    {
        $this->assertNotEquals(
            [],
            CsvArrayData::serveArrayData('./public/test.csv')
        );
    }

    public function testNotExistingCsvFile()
    {
        $this->assertEquals(
            [],
            CsvArrayData::serveArrayData('./public/notexist.csv')
        );
    }
}
