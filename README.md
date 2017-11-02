## Contract type cast array library

## Usage

```php

class Awesome {
  public function getInt(): int {}
  public function getBool(): bool {}
  public function getString(): string {}
  public function getFloat(): float {}
  public function getAwesomes(): array {}
  public function addAwesome(Awesome $awesome) {} // symfony property access mutator, needs for arrayOf recognize
}

$converter = (new Necronru\TypeConverter\TypeConverterBuilder())->build();

$data = [
    'int' => "1",
    'bool' => 'true',
    'string' => 1,
    'awesomes' => [
      [
        'int' => "1",
        'bool' => 'true',
        'string' => 1,
      ]
    ]
];

var_export($converter->convert($data, Awesome::class));
```

Result:
```
array (
  'int' => 1,
  'bool' => true,
  'string' => '1',
  'awesomes' => 
  array (
    0 => 
    array (
      'int' => 1,
      'bool' => true,
      'string' => '1',
    ),
  ),
);
```


