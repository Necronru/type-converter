<?php


namespace Necronru\Tests\Converter;


use Necronru\Converter\Converter;
use Necronru\Tests\Contract\TestContract;
use Necronru\Schema\SchemaGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

class ConvertStringPropertiesTest extends TestCase
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
        $actual = $this->converter->convert($data, TestContract::class);

        $this->assertEquals($expected, $actual);

    }

}