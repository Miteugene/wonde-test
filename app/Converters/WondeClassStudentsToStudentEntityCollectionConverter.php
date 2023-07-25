<?php

namespace App\Converters;

use App\Collections\Entities\StudentEntityCollection;
use App\Entities\StudentEntity;

class WondeClassStudentsToStudentEntityCollectionConverter
{
    /**
     * @param $class
     * @return StudentEntityCollection
     */
    public function handle(
        $class
    ): StudentEntityCollection
    {
        $studentEntityCollection = new StudentEntityCollection();

        $studentsData = $class?->students?->data;

        if (!$studentsData) {
            return $studentEntityCollection;
        }

        foreach ($studentsData as $studentData) {
            $studentEntity = new StudentEntity();
            $studentEntity->fill([
                'id' => $studentData->id,
                'forename' => $studentData->forename,
                'surname' => $studentData->surname,
            ]);

            $studentEntityCollection->push($studentEntity);
        }

        return $studentEntityCollection;
    }
}
