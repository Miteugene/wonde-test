<?php

declare(strict_types=1);

namespace App\Actions\Employee;

use App\Collections\Entities\EmployeeEntityCollection;
use App\Converters\WondeEmployeesToEmployeeEntityCollectionConverter;
use App\Features\Wonde\GetSchoolFeature;
use App\Http\Requests\EmployeeIndexRequest;

class EmployeeIndexAction
{
    private const INCLUDES = [];
    private const PARAMETERS = [
        'has_class' => 1,
    ];

    /**
     * @param EmployeeIndexRequest $request
     * @param GetSchoolFeature $getSchoolFeature
     * @param WondeEmployeesToEmployeeEntityCollectionConverter $employeesToEmployeeEntityCollectionConverter
     */
    public function __construct(
        private EmployeeIndexRequest $request,
        private GetSchoolFeature $getSchoolFeature,
        private WondeEmployeesToEmployeeEntityCollectionConverter $employeesToEmployeeEntityCollectionConverter,
    )
    {
        // Nothing
    }

    /**
     * @return EmployeeEntityCollection
     * @throws \Wonde\Exceptions\InvalidTokenException
     */
    public function handle(): EmployeeEntityCollection
    {
        // todo: handle exception
        $school = $this->getSchoolFeature->handle();

        $employees = $school->employees->all(
            self::INCLUDES,
            self::PARAMETERS,
        );

        return $this->employeesToEmployeeEntityCollectionConverter->handle($employees);
    }
}
