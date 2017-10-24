<?php


namespace Necronru\Tests\Converter;


use Necronru\Converter\Converter;
use Necronru\Tests\Contract\TestContract;
use Necronru\Schema\SchemaGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

class ConvertIntPropertiesTest extends TestCase
{
    /**
     * @var \Necronru\Converter\Converter
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
                    'intTest'             => null,
                    'nullableIntTest'     => null,
                ],
                [
                    'intTest'             => 0,
                    'nullableIntTest'     => null,
                ],
            ],
            [
                [
                    'intTest'             => 0,
                    'nullableIntTest'     => 0,
                ],
                [
                    'intTest'             => 0,
                    'nullableIntTest'     => 0,
                ],
            ],
            [
                [
                    'intTest'             => 1,
                    'nullableIntTest'     => 1,
                ],
                [
                    'intTest'             => 1,
                    'nullableIntTest'     => 1,
                ],
            ],
            [
                [
                    'intTest'             => '100',
                    'nullableIntTest'     => '100',
                ],
                [
                    'intTest'             => 100,
                    'nullableIntTest'     => 100,
                ],
            ],
            [
                [
                    'intTest'             => 'null',
                    'nullableIntTest'     => 'null',
                ],
                [
                    'intTest'             => 0,
                    'nullableIntTest'     => 0,
                ],
            ],
            [
                [
                    'intTest'             => '0',
                    'nullableIntTest'     => '0',
                ],
                [
                    'intTest'             => 0,
                    'nullableIntTest'     => 0,
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