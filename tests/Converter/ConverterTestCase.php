<?php


namespace Necronru\Tests\Converter;


use Necronru\Converter\ArrayConverter;
use Necronru\Converter\ArrayConverterBuilder;
use PHPUnit\Framework\TestCase;

class ConverterTestCase extends TestCase
{
    /**
     * @var ArrayConverter
     */
    private $converter;

    public function setUp()
    {
        $this->converter = (new ArrayConverterBuilder())->build();
    }

    /**
     * @return ArrayConverter
     */
    public function getConverter(): ArrayConverter
    {
        return $this->converter;
    }

}