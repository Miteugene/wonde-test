<?php

declare(strict_types=1);

namespace App\Entities;

class EmployeeEntity extends Entity
{
    public ?string $id;
    public ?string $title;
    public ?string $forename;
    public ?string $surname;
}
