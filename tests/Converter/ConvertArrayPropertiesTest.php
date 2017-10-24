<?php


namespace Necronru\Tests\Converter;


use Necronru\Tests\Contract\TestContract;

class ConvertArrayPropertiesTest extends ConverterTestCase
{
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
        $actual = $this->getConverter()->convert($data, TestContract::class);

//        dump([
//            'data'     => $data,
//            'actual'   => $actual,
//            'expected' => $expected,
//        ]);

        $this->assertEquals($expected, $actual, true);

    }

}