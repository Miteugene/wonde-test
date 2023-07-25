<?php

namespace App\Converters;

use App\Collections\Entities\EmployeeEntityCollection;
use App\Entities\EmployeeEntity;

class WondeEmployeesToEmployeeEntityCollectionConverter
{
    /**
     * @param $employees
     * @return EmployeeEntityCollection
     */
    public function handle(
        $employees
    ): EmployeeEntityCollection
    {
        $employeeEntityCollection = new EmployeeEntityCollection();

        foreach ($employees as $employee) {
            $employeeEntity = new EmployeeEntity();
            $employeeEntity->fill([
                'id' => $employee->id,
                'title' => $employee->title,
                'forename' => $employee->forename,
                'surname' => $employee->surname,
            ]);
            $employeeEntityCollection->push($employeeEntity);
        }

        return $employeeEntityCollection;
    }
}
