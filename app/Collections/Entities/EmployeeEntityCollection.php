<?php

namespace App\Collections\Entities;

use App\Entities\EmployeeEntity;

class EmployeeEntityCollection extends EntityCollection
{
    /**
     * Name of items class.
     *
     * @var class-string|string|null
     */
    protected ?string $className = EmployeeEntity::class;
}
