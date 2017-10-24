<?php


namespace Necronru\Tests\Converter;


use Necronru\Converter\Converter;
use Necronru\Converter\ConverterBuilder;
use PHPUnit\Framework\TestCase;

class ConverterTestCase extends TestCase
{
    /**
     * @var Converter
     */
    private $converter;

    public function setUp()
    {
        $this->converter = (new ConverterBuilder())->build();
    }

    /**
     * @return Converter
     */
    public function getConverter(): Converter
    {
        return $this->converter;
    }

}