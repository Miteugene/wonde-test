<?php

declare(strict_types=1);

namespace App\Actions\Lesson;

use App\Collections\Entities\LessonEntityCollection;
use App\Converters\WondeEmployeeLessonsToLessonEntityCollectionConverter;
use App\Features\Wonde\GetSchoolFeature;
use App\Http\Requests\LessonShowRequest;
use Carbon\Carbon;

class LessonShowAction
{
    private Carbon $date;

    private const INCLUDES = [
        'classes.lessons',
    ];

    /**
     * @param LessonShowRequest $request
     * @param GetSchoolFeature $getSchoolFeature
     * @param WondeEmployeeLessonsToLessonEntityCollectionConverter $employeeLessonsToLessonEntityCollectionConverter
     */
    public function __construct(
        private LessonShowRequest                                     $request,
        private GetSchoolFeature                                      $getSchoolFeature,
        private WondeEmployeeLessonsToLessonEntityCollectionConverter $employeeLessonsToLessonEntityCollectionConverter,
    )
    {
        // Nothing
    }

    /**
     * @return LessonEntityCollection
     * @throws \Wonde\Exceptions\InvalidTokenException
     */
    public function handle(): LessonEntityCollection
    {
        $employeeId = $this->request->input('employee_id');

        $this->date = Carbon::parse(
            $this->request->input('date')
        );

        // todo: handle exception
        $school = $this->getSchoolFeature->handle();

        $employee = $school->employees->get(
            $employeeId,
            self::INCLUDES,
            [
                'lessons_start_after' => $this->date->startOfWeek()->format('Y-m-d H:i:s'),
                'lessons_start_before' => $this->date->endOfWeek()->format('Y-m-d H:i:s'),
            ]
        );

        return $this->employeeLessonsToLessonEntityCollectionConverter->handle($employee);
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        $dateNextWeek = (clone $this->date)->addWeek();
        $datePrevWeek = (clone $this->date)->subWeek();

        return [
            'start_of_week' => $this->date->startOfWeek()->format('Y-m-d'),
            'end_of_week' => $this->date->endOfWeek()->format('Y-m-d'),
            'next_start_of_week' => $dateNextWeek->startOfWeek()->format('Y-m-d'),
            'next_end_of_week' => $dateNextWeek->endOfWeek()->format('Y-m-d'),
            'prev_start_of_week' => $datePrevWeek->startOfWeek()->format('Y-m-d'),
            'prev_end_of_week' => $datePrevWeek->endOfWeek()->format('Y-m-d'),
        ];
    }
}
