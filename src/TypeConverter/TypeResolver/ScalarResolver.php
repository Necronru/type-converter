<?php


namespace Necronru\TypeConverter\TypeResolver;

use Psr\Log\LoggerInterface;

class ScalarResolver implements ITypeResolver
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function supportType(string $type, array $propertySchema): bool
    {
        return in_array($type, $this->supportTypes(), true);
    }

    protected function supportTypes(): array
    {
        return ['int', 'float', 'array'];
    }

    public function convert(&$value, string $type, bool $nullable): void
    {
        if ($nullable && null === $value) {
            return;
        }

        settype($value, $type);
    }

}