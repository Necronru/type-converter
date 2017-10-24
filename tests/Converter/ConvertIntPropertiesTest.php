<?php


namespace Necronru\Tests\Converter;


use Necronru\Tests\Contract\TestContract;

class ConvertIntPropertiesTest extends ConverterTestCase
{
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
        $actual = $this->getConverter()->convert($data, TestContract::class);

//        dump([
//            'data'     => $data,
//            'actual'   => $actual,
//            'expected' => $expected,
//        ]);

        $this->assertEquals($expected, $actual);

    }

}