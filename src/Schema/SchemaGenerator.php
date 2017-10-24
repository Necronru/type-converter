<?php


namespace Necronru\Schema;


use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractorInterface;
use Symfony\Component\PropertyInfo\Type;

class SchemaGenerator
{
    /**
     * @var ReflectionExtractor
     */
    private $extractor;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var CacheItemPoolInterface|null
     */
    private $cachePool;

    private $arrayCache = [];

    public function __construct(ReflectionExtractor $extractor,
                                CacheItemPoolInterface $cachePool = null,
                                LoggerInterface $logger = null)
    {
        $this->extractor = $extractor;
        $this->logger = $logger ? $logger : new NullLogger();
        $this->cachePool = $cachePool;
    }


    public function getSchemaRecursive($entityClass): array
    {
        $classes = (array) $entityClass;

        $schema = [];

        foreach ($classes as $key => $className) {

            $schema[$className] = $this->getClassSchema($className);

            foreach ($schema[$className] as $property => $propertySchema) {
                if (true === $propertySchema['is_collection'] && 'array' !== $propertySchema['type']) {
                    $subClassName = $propertySchema['type'];

                    if (preg_match('/(.*)(\[\])$/', $subClassName, $matches)) {
                        $subClassName = $matches[1];
                    }

                    $schema[$subClassName] = $this->getClassSchema($subClassName);
                }
            }
        }

        return $schema;

    }

    protected function getClassSchema($className)
    {
        if (key_exists($className, $this->arrayCache)) {
            return $this->arrayCache[$className];
        }

        $schema = $this->getSchemaFromCache($className);

        $this->arrayCache[$className] = $schema;

        return $schema;
    }

    protected function getSchemaFromCache($className)
    {
        if (!$this->cachePool) {
            return $this->readClassSchema($className);
        }

        $item = $this->cachePool->getItem($className);

        if ($item->isHit()) {
            return $item->get();
        }

        $schema = $this->readClassSchema($className);

        $item->set($schema);
        $this->cachePool->save($item);

        return $schema;
    }

    protected function readClassSchema($className)
    {
        $this->logger->debug('read class schema ' . $className);

        $schema = [];

        $properties = (array)$this->extractor->getProperties($className);

        foreach ($properties as $property) {
            $this->logger->debug('get property types ' . $property, ['class' => $className]);
            $propertySchema = $this->extractor->getTypes($className, $property)[0];

            if (!$propertySchema) {
                $this->logger->warning('can\'t get types for property ' . $property, ['class' => $className]);
                continue;
            }

            if ($propertySchema->isCollection()) {

                if ($collectionValueType = $propertySchema->getCollectionValueType()) {
                    $schema[$property] = $this->arrayOf($collectionValueType);
                } else {
                    $schema[$property] = $this->array($propertySchema);
                }

                continue;
            }

            $schema[$property] = $this->scalar($propertySchema);
        }

        return $schema;
    }

    protected function scalar(Type $schema)
    {
        $type = $schema->getBuiltinType();

        if ('object' === $type) {
            $type = $schema->getClassName();
        }

        return [
            'type'          => $type,
            'nullable'      => $schema->isNullable(),
            'is_collection' => $schema->isCollection(),
        ];
    }

    protected function array(Type $schema)
    {
        return [
            'type'          => 'array',
            'nullable'      => $schema->isNullable(),
            'is_collection' => false,
        ];
    }

    protected function arrayOf(Type $schema)
    {
        $type = ($schema->getClassName()) ? $schema->getClassName() : $schema->getBuiltinType();

        return [
            'type'          => sprintf('%s[]', $type),
            'nullable'      => false,
            'is_collection' => true,
        ];
    }

}