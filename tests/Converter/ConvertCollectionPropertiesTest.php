<?php


namespace Necronru\Tests\Converter;


use Necronru\Converter\Converter;
use Necronru\Tests\Contract\TestContract;
use Necronru\Schema\SchemaGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

class ConvertCollectionPropertiesTest extends TestCase
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
        $actual = $this->converter->convert($data, TestContract::class);

        dump([
            'data'     => $data,
            'actual'   => $actual,
            'expected' => $expected,
        ]);

        $this->assertEquals($expected, $actual, true);

    }

}