<?php
declare(strict_types=1);

namespace LoyaltyCorp\SdkBlueprint\Sdk;

use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\UndefinedClassException;

class ObjectFactory
{
    /**
     * @var \Symfony\Component\Serializer\Serializer $serializer
     */
    private $serializer;

    public function __construct()
    {
        $this->serializer = (new SerializerFactory())->create();
    }

    /**
     * @param mixed $data
     * @param string $class
     *
     * @return object
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\UndefinedClassException
     */
    public function create(array $data, $class)
    {
        if (\class_exists($class) === false) {
            throw new UndefinedClassException(\sprintf('class %s is not defined', $class));
        }

        return $this->serializer->denormalize($data, $class);
    }
}
