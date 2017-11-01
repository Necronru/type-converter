<?php


namespace Necronru\TypeConverter;


use Necronru\TypeConverter\TypeResolver\BooleanResolver;
use Necronru\TypeConverter\TypeResolver\ITypeResolver;
use Necronru\TypeConverter\TypeResolver\ScalarResolver;
use Necronru\TypeConverter\TypeResolver\StringResolver;
use Necronru\Schema\SchemaGenerator;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

class TypeConverterBuilder
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ITypeResolver[]
     */
    private $resolvers;

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * ConverterBuilder constructor.
     *
     * @param LoggerInterface|null        $logger
     * @param CacheItemPoolInterface|null $cache
     */
    public function __construct(LoggerInterface $logger = null, CacheItemPoolInterface $cache = null)
    {
        $this->logger = $logger ?? new NullLogger();

        $this->resolvers = [
            new BooleanResolver($this->logger),
            new StringResolver($this->logger),
            new ScalarResolver($this->logger),
        ];

        $this->cache = $cache;
    }


    /**
     * @return TypeConverter
     */
    public function build()
    {
        return new TypeConverter(new SchemaGenerator(new ReflectionExtractor(), $this->cache), $this->resolvers);
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ITypeResolver[] $resolvers
     */
    public function setResolvers(array $resolvers)
    {
        foreach ($resolvers as $resolver) {
            $this->addTypeResolver($resolver);
        }
    }

    public function addTypeResolver(ITypeResolver $resolver)
    {
        $this->resolvers[get_class($resolver)] = $resolver;
    }

}