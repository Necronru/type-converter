<?php


namespace Necronru\Converter;


use Necronru\Converter\TypeResolver\BooleanResolver;
use Necronru\Converter\TypeResolver\ITypeResolver;
use Necronru\Converter\TypeResolver\ScalarResolver;
use Necronru\Converter\TypeResolver\StringResolver;
use Necronru\Schema\SchemaGenerator;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

class ConverterBuilder
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
     * @return Converter
     */
    public function build()
    {
        return new Converter(new SchemaGenerator(new ReflectionExtractor(), $this->cache), $this->resolvers);
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