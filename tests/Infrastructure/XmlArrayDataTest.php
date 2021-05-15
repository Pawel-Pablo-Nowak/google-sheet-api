<?php
declare(strict_types=1);

namespace App\Tests\Infrastructure;

use App\Infrastructure\ArrayData\XmlArrayData;
use PHPUnit\Framework\TestCase;

class XmlArrayDataTest extends TestCase
{
    public function testXMLServe()
    {
        $this->assertEquals(
            [
                [
                    'entity_id',
                    'CategoryName',
                    'sku',
                    'name',
                    'description',
                    'shortdesc',
                    'price',
                    'link',
                    'image',
                    'Brand',
                    'Rating',
                    'CaffeineType',
                    'Count',
                    'Flavored',
                    'Seasonal',
                    'Instock',
                    'Facebook',
                    'IsKCup'

                ],
                [
                    340,
                    'Green Mountain Ground Coffee',
                    '20',
                    'Green Mountain Coffee French Roast Ground Coffee 24 2.2oz Bag',
                    '',
                    'Green Mountain Coffee French Roast Ground Coffee 24 2.2oz Bag steeps cup after cup of smoky-sweet, complex dark roast coffee from Green Mountain Ground Coffee.',
                    41.6,
                    'http://www.coffeeforless.com/green-mountain-coffee-french-roast-ground-coffee-24-2-2oz-bag.html',
                    'http://mcdn.coffeeforless.com/media/catalog/product/images/uploads/intro/frac_box.jpg',
                    'Green Mountain Coffee',
                    0,
                    'Caffeinated',
                    24,
                    'No',
                    'No',
                    'Yes',
                    1,
                    0
                ]
            ],
            XmlArrayData::serveArrayData('./public/coffee_feed_test.xml')
        );
    }

    public function testEmptyXmlServe()
    {
        $this->assertNotEquals(
            [],
            XmlArrayData::serveArrayData('./public/coffee_feed_test.xml')
        );
    }

    public function testNotExistingXmlFile()
    {
        $this->assertEquals(
            [],
            XmlArrayData::serveArrayData('./public/coffee_feed_test_not_exist.xml')
        );
    }
}
