<?php


namespace Necronru\Tests\Converter;


use Necronru\Converter\Converter;
use Necronru\Tests\Contract\TestContract;
use Necronru\Schema\SchemaGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

class ConvertFloatPropertiesTest extends TestCase
{
    /**
     * @var Converter
     */
    protected $converter;

    public function setUp()
    {
        $this->converter = new Converter(new SchemaGenerator(new ReflectionExtractor()));
    }

    public function dataProvider()
    {
        return [
            [
                [
                    'floatTest'          => null,
                    'nullableFloatTest'  => null,
                ],
                [
                    'floatTest'          => 0.0,
                    'nullableFloatTest'  => null,
                ],
            ],
            [
                [
                    'floatTest'          => 0,
                    'nullableFloatTest'  => 0,
                ],
                [
                    'floatTest'          => 0.0,
                    'nullableFloatTest'  => 0.0,
                ],
            ],
            [
                [
                    'floatTest'          => 1,
                    'nullableFloatTest'  => 1,
                ],
                [
                    'floatTest'          => 1.0,
                    'nullableFloatTest'  => 1.0,
                ],
            ],
            [
                [
                    'floatTest'          => '100',
                    'nullableFloatTest'  => '100',
                ],
                [
                    'floatTest'          => 100.0,
                    'nullableFloatTest'  => 100.0,
                ],
            ],
            [
                [
                    'floatTest'          => 'null',
                    'nullableFloatTest'  => 'null',
                ],
                [
                    'floatTest'          => 0.0,
                    'nullableFloatTest'  => 0.0,
                ],
            ],
            [
                [
                    'floatTest'          => '0',
                    'nullableFloatTest'  => '0',
                ],
                [
                    'floatTest'          => 0.0,
                    'nullableFloatTest'  => 0.0,
                ],
            ],
            [
                [
                    'floatTest'          => '1.5',
                    'nullableFloatTest'  => '1.5',
                ],
                [
                    'floatTest'          => 1.5,
                    'nullableFloatTest'  => 1.5,
                ],
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     *
     * @param $data
     * @param $expected
     */
    public function testConvert($data, $expected)
    {
        $actual = $this->converter->convert($data, TestContract::class);

//        dump([
//            'data'     => $data,
//            'actual'   => $actual,
//            'expected' => $expected,
//        ]);

        $this->assertEquals($expected, $actual);
    }

}