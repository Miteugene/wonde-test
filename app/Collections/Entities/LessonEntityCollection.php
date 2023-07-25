<?php

namespace App\Collections\Entities;

use App\Entities\LessonEntity;

class LessonEntityCollection extends EntityCollection
{
    /**
     * Name of items class.
     *
     * @var class-string|string|null
     */
    protected ?string $className = LessonEntity::class;
}
