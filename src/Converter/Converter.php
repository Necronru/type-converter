<?php


namespace Necronru\Converter;


use Necronru\Converter\TypeResolver\BooleanResolver;
use Necronru\Converter\TypeResolver\ITypeResolver;
use Necronru\Converter\TypeResolver\ScalarResolver;
use Necronru\Converter\TypeResolver\StringResolver;
use Necronru\Schema\SchemaGenerator;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Converter
{
    /**
     * @var SchemaGenerator
     */
    private $schema;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ITypeResolver[]
     */
    private $resolvers = [];

    /**
     * Converter constructor.
     *
     * @param SchemaGenerator      $schema
     * @param ITypeResolver[]      $typeResolvers
     * @param LoggerInterface|null $logger
     */
    public function __construct(SchemaGenerator $schema, array $typeResolvers, LoggerInterface $logger = null)
    {
        $this->schema = $schema;
        $this->logger = $logger ? $logger : new NullLogger();
        $this->resolvers = $typeResolvers;
    }

    public function convert($data, $type, $strict = true)
    {
        $this->logger->debug('start converting', ['type' => $type]);
        $isCollection = preg_match('/(.*)(\[\])$/', $type, $matches);

        if ($isCollection) {
            $type = $matches[1];
        }

        $schema = $this->schema->getSchemaRecursive($type);

        if (!$isCollection) {
            return $this->convertItem($data, $schema, $type, $strict);
        }

        $this->logger->debug('convert collection', ['type' => $type]);

        $key = array_keys($data);
        $size = sizeOf($key);

        for ($i = 0; $i < $size; $i++) {
            $data[$key[$i]] = $this->convertItem($data[$key[$i]], $schema, $type, $strict);
        }

        return $data;
    }

    protected function convertItem($data, array $schema, string $type, bool $strict)
    {
        $classSchema = $schema[$type];

        $this->logger->debug('convert item', ['type' => $type, 'data' => $data, 'schema' => $classSchema]);

        $keys = array_keys($classSchema);
        $size = sizeOf($keys);

        for ($i = 0; $i < $size; $i++) {

            if (!key_exists($keys[$i], $data)) {
                $this->logger->debug("skip value for \"$keys[$i]\"");
                continue;
            }

            $this->logger->debug('convert property ' . $keys[$i], ['value' => $data[$keys[$i]]]);

            $type = $classSchema[$keys[$i]]['type'];

            foreach ($this->resolvers as $resolver) {

                if (!$resolver->supportType($type, $classSchema)) {
                    continue;
                }

                $resolver->convert($data[$keys[$i]], $type, $classSchema[$keys[$i]]['nullable']);
                break;
            }

            // convert collection
            if ($classSchema[$keys[$i]]['is_collection']) {
                $data[$keys[$i]] = $this->convert($data[$keys[$i]], $type, $strict);
                continue;
            }
        }

        return $data;
    }
}