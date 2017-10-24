<?php


namespace Necronru\Converter\TypeResolver;


interface ITypeResolver
{
    public function supportType(string $type, array $propertySchema): bool;

    public function convert(&$value, string $type, bool $nullable): void;
}