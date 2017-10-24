<?php


namespace Necronru\Tests\Converter;


use Necronru\Tests\Contract\TestContract;

class ConvertBoolPropertiesTest extends ConverterTestCase
{
    public function dataProvider() {
        return [
            0 => [
                [
                    'boolTest'            => null,
                    'nullableBoolTest'    => null,
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => null,
                ],
            ],
            1 => [
                [
                    'boolTest'            => 0,
                    'nullableBoolTest'    => 0,
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => false,
                ],
            ],
            2 => [
                [
                    'boolTest'            => 1,
                    'nullableBoolTest'    => 1,
                ],
                [
                    'boolTest'            => true,
                    'nullableBoolTest'    => true,
                ],
            ],
            3 => [
                [
                    'boolTest'            => true,
                    'nullableBoolTest'    => true,
                ],
                [
                    'boolTest'            => true,
                    'nullableBoolTest'    => true,
                ],
            ],
            4 => [
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => false,
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => false,
                ],
            ],
            5 => [
                [
                    'boolTest'            => '0',
                    'nullableBoolTest'    => '0',
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => false,
                ],
            ],
            6 => [
                [
                    'boolTest'            => '1',
                    'nullableBoolTest'    => '1',
                ],
                [
                    'boolTest'            => true,
                    'nullableBoolTest'    => true,
                ],
            ],
            7 => [
                [
                    'boolTest'            => '',
                    'nullableBoolTest'    => '',
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => false,
                ],
            ],
            8 => [
                [
                    'boolTest'            => 0.1,
                    'nullableBoolTest'    => 0.1,
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => null,
                ],
            ],
            9 => [
                [
                    'boolTest'            => '0.0',
                    'nullableBoolTest'    => '0.0',
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => null,
                ],
            ],
            10 => [
                [
                    'boolTest'            => 'test',
                    'nullableBoolTest'    => 'test',
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => null,
                ],
            ],
            11 => [
                [
                    'boolTest'            => 'true',
                    'nullableBoolTest'    => 'true',
                ],
                [
                    'boolTest'            => true,
                    'nullableBoolTest'    => true,
                ],
            ],
            12 => [
                [
                    'boolTest'            => 'false',
                    'nullableBoolTest'    => 'false',
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => false,
                ],
            ],
            13 => [
                [
                    'boolTest'            => 'null',
                    'nullableBoolTest'    => 'null',
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => null,
                ],
            ],
            14 => [
                [
                    'boolTest'            => '0.1',
                    'nullableBoolTest'    => '0.1',
                ],
                [
                    'boolTest'            => false,
                    'nullableBoolTest'    => null,
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