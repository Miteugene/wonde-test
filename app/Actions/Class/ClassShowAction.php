<?php

declare(strict_types=1);

namespace App\Actions\Class;

use App\Collections\Entities\StudentEntityCollection;
use App\Converters\WondeClassStudentsToStudentEntityCollectionConverter;
use App\Features\Wonde\GetSchoolFeature;
use App\Http\Requests\ClassShowRequest;

class ClassShowAction
{
    private const INCLUDES = [
        'students',
    ];

    /**
     * @param ClassShowRequest $request
     * @param GetSchoolFeature $getSchoolFeature
     * @param WondeClassStudentsToStudentEntityCollectionConverter $classStudentsToStudentEntityCollectionConverter
     */
    public function __construct(
        private ClassShowRequest $request,
        private GetSchoolFeature $getSchoolFeature,
        private WondeClassStudentsToStudentEntityCollectionConverter $classStudentsToStudentEntityCollectionConverter
    )
    {
        // Nothing
    }

    /**
     * @return StudentEntityCollection
     * @throws \Wonde\Exceptions\InvalidTokenException
     */
    public function handle(): StudentEntityCollection
    {
        $this->request->validated();

        $classId = $this->request->route('classId');

        // todo: handle exception
        $school = $this->getSchoolFeature->handle();

        $class = $school->classes->get($classId, self::INCLUDES);

        return $this->classStudentsToStudentEntityCollectionConverter->handle($class);
    }
}
