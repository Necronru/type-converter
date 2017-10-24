<?php


namespace Necronru\Tests\Converter;


use Necronru\Tests\Contract\TestContract;

class ConvertCollectionPropertiesTest extends ConverterTestCase
{
    public function dataProvider()
    {
        return [
            [
                [
                    'intTest' => "1",
                    'tests' => [
                        [
                            'intTest' => "1",
                            'boolTest' => 1,
                            'arrayTest' => 1,
                            'tests' => [
                                [
                                    'intTest' => "1",
                                    'boolTest' => 1,
                                    'arrayTest' => 1,
                                    'tests' => [
                                        [
                                            'intTest' => "1",
                                            'boolTest' => 1,
                                            'arrayTest' => 1,
                                        ]
                                    ],
                                ]
                            ],
                        ]
                    ],
                ],
                [
                    'intTest' => 1,
                    'tests' => [
                        [
                            'intTest' => 1,
                            'boolTest' => true,
                            'arrayTest' => [1],
                            'tests' => [
                                [
                                    'intTest' => 1,
                                    'boolTest' => true,
                                    'arrayTest' => [1],
                                    'tests' => [
                                        [
                                            'intTest' => 1,
                                            'boolTest' => true,
                                            'arrayTest' => [1],
                                        ]
                                    ],
                                ]
                            ],
                        ]
                    ],
                ],
            ]
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

        dump([
            'data'     => $data,
            'actual'   => $actual,
            'expected' => $expected,
        ]);

        $this->assertEquals($expected, $actual, true);

    }

}