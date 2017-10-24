<?php


namespace Necronru\Converter\TypeResolver;


use Psr\Log\LoggerInterface;

class BooleanResolver implements ITypeResolver
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
        return 'bool' === $type;
    }

    public function convert(&$value, string $type, bool $nullable): void
    {
        if ($nullable && null === $value) {
            return;
        }

        if ($nullable && 'null' === $value) {
            $value = null;
            return;
        }

        $value = filter_var(
            $value, FILTER_VALIDATE_BOOLEAN, $nullable ? FILTER_NULL_ON_FAILURE : null
        );
    }
}