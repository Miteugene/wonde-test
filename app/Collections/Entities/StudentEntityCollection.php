<?php

namespace App\Collections\Entities;

use App\Entities\StudentEntity;

class StudentEntityCollection extends EntityCollection
{
    /**
     * Name of items class.
     *
     * @var class-string|string|null
     */
    protected ?string $className = StudentEntity::class;
}
