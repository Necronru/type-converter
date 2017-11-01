<?php


namespace Necronru\Tests\Converter;


use Necronru\TypeConverter\TypeConverter;
use Necronru\TypeConverter\TypeConverterBuilder;
use PHPUnit\Framework\TestCase;

class ConverterTestCase extends TestCase
{
    /**
     * @var TypeConverter
     */
    private $converter;

    public function setUp()
    {
        $this->converter = (new TypeConverterBuilder())->build();
    }

    /**
     * @return TypeConverter
     */
    public function getConverter(): TypeConverter
    {
        return $this->converter;
    }

}