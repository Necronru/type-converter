<?php


namespace Necronru\Converter\TypeResolver;

use Psr\Log\LoggerInterface;

class StringResolver implements ITypeResolver
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
        return 'string' === $type;
    }

    public function convert(&$value, string $type, bool $nullable): void
    {
        if ($nullable && null === $value) {
            return;
        }

        settype($value, $type);
    }

}