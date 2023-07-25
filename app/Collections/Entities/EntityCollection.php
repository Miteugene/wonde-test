<?php

namespace App\Collections\Entities;

use App\Entities\Entity;
use Illuminate\Support\Collection;
use Iterator;
use ArrayIterator;

/**
 * @template TKey of int|string
 * @template TValue of Entity
 *
 * @extends Collection<TValue>
 */
class EntityCollection extends Collection
{
    /**
     * Name of the class
     *
     * @var class-string|string|null
     */
    protected ?string $className = null;

    /**
     * @return array<TKey, TValue>|Iterator<TKey, TValue>
     *
     * @noinspection PhpDocSignatureInspection
     */
    public function getIterator(): ArrayIterator
    {
        return parent::getIterator();
    }

    /**
     * @param callable|null $callback
     * @param null $default
     *
     * @return TValue|null
     */
    public function first(callable $callback = null, $default = null): ?Entity
    {
        return parent::first($callback, $default);
    }
}
