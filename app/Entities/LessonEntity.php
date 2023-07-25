<?php

namespace App\Entities;

class LessonEntity extends Entity
{
    public ?string $id;
    public ?string $date;
    public ?string $timeStartAt;
    public ?string $timeEndAt;
    public ?string $classId;
    public ?string $className;
    public ?string $color;
    public ?int $dayOfWeek;
    public ?int $hourStart;
    public ?int $hourEnd;
    public ?int $duration;
    public ?int $percentOfHourStart;
    public ?int $percentOfHourEnd;
}
