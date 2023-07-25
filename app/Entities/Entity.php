<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionProperty;

abstract class Entity implements Arrayable
{
    /**
     * Entity constructor.
     *
     * @param mixed ...$attributes
     */
    public function __construct(...$attributes)
    {
        $this->fill($attributes);
    }

    /**
     * Fill entity with attributes
     *
     * @param array $attributes
     * @return $this
     */
    public function fill(array $attributes): static
    {
        if (empty($attributes)) {
            return $this;
        }

        $attributesMap = [];
        foreach ($attributes as $key => $value) {
            $attributesMap[$key] = $value;
        }

        $reflection = new ReflectionClass(static::class);
        $reflectionProperties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($reflectionProperties as $reflectionProperty) {
            if ($reflectionProperty->isStatic()) {
                continue;
            }

            $propertyName = $reflectionProperty->getName();

            if (array_key_exists($propertyName, $attributesMap)) {
                $reflectionProperty->setValue(
                    $this,
                    $attributesMap[$propertyName]
                );
            }
        }

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $reflectionClass = new ReflectionClass($this);
        $result = [];

        foreach ($reflectionClass->getProperties() as $reflectionProperty) {
            if ($reflectionProperty->isInitialized($this) === false) {
                continue;
            }

            $propertyName = $reflectionProperty->getName();
            $result[Str::snake($propertyName)] = $reflectionProperty->getValue($this);
        }

        return $result;
    }
}
