<?php


namespace Necronru\Tests\Contract;


abstract class TestContract
{
    abstract function getIntTest(): int;

    abstract function getNullableIntTest(): ?int;

    abstract function getFloatTest(): float;

    abstract function getNullableFloatTest(): ?float;

    abstract function getStringTest(): string;

    abstract function getNullableStringTest(): ?string;

    abstract function getBoolTest(): bool;

    abstract function getNullableBoolTest(): ?bool;

    abstract function getArrayTest(): array;

    abstract function getNullableArrayTest(): ?array;

    abstract function addTests(TestContract $test);
}