<?php


namespace Necronru\Tests\Converter;


use Necronru\Tests\Contract\TestContract;

class ConvertStringPropertiesTest extends ConverterTestCase
{
    public function dataProvider()
    {
        return [
            [
                [
                    'stringTest'             => null,
                    'nullableStringTest'     => null,
                ],
                [
                    'stringTest'         => "",
                    'nullableStringTest' => null,
                ],
            ],
            [
                [
                    'stringTest'             => "",
                    'nullableStringTest'     => "",
                ],
                [
                    'stringTest'         => "",
                    'nullableStringTest' => "",
                ],
            ],
            [
                [
                    'stringTest'             => 0,
                    'nullableStringTest'     => 0,
                ],
                [
                    'stringTest'         => "0",
                    'nullableStringTest' => "0",
                ],
            ],
            [
                [
                    'stringTest'             => "null",
                    'nullableStringTest'     => "null",
                ],
                [
                    'stringTest'         => "null",
                    'nullableStringTest' => "null",
                ],
            ],
            [
                [
                    'stringTest'             => true,
                    'nullableStringTest'     => false,
                ],
                [
                    'stringTest'         => "1",
                    'nullableStringTest' => "",
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

        $this->assertEquals($expected, $actual);

    }

}