<?php


namespace Necronru\Tests\Converter;


use Necronru\Converter\Converter;
use Necronru\Tests\Contract\TestContract;
use Necronru\Schema\SchemaGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

class ConvertArrayPropertiesTest extends TestCase
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
                    'arrayTest'         => null,
                    'nullableArrayTest' => null,
                ],
                [
                    'arrayTest'         => [],
                    'nullableArrayTest' => null,
                ],
            ],
            [
                [
                    'arrayTest'         => [1, 2, 3],
                    'nullableArrayTest' => [1, 2, 3],
                ],
                [
                    'arrayTest'         => [1, 2, 3],
                    'nullableArrayTest' => [1, 2, 3],
                ],
            ],
            [
                [
                    'arrayTest'         => "",
                    'nullableArrayTest' => "",
                ],
                [
                    'arrayTest'         => [""],
                    'nullableArrayTest' => [""],
                ],
            ],
            [
                [
                    'arrayTest'         => "1",
                    'nullableArrayTest' => "1",
                ],
                [
                    'arrayTest'         => ["1"],
                    'nullableArrayTest' => ["1"],
                ],
            ],
            [
                [
                    'arrayTest'         => 1,
                    'nullableArrayTest' => 1,
                ],
                [
                    'arrayTest'         => [1],
                    'nullableArrayTest' => [1],
                ],
            ],
            [
                [
                    'arrayTest'         => 0,
                    'nullableArrayTest' => 0,
                ],
                [
                    'arrayTest'         => [0],
                    'nullableArrayTest' => [0],
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

        $this->assertEquals($expected, $actual, true);

    }

}