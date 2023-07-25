<?php

namespace App\Converters;

use App\Collections\Entities\LessonEntityCollection;
use App\Entities\LessonEntity;
use App\Features\GetColorFromStringFeature;
use Carbon\Carbon;

class WondeEmployeeLessonsToLessonEntityCollectionConverter
{
    public function __construct(
        private GetColorFromStringFeature $getColorFromStringFeature,
    )
    {
        // Nothing
    }

    /**
     * @param $employee
     * @return LessonEntityCollection
     */
    public function handle(
        $employee
    ): LessonEntityCollection
    {
        $lessonEntityCollection = new LessonEntityCollection();

        $classesData = $employee?->classes?->data;

        if (!$classesData) {
            return $lessonEntityCollection;
        }

        foreach ($classesData as $classData) {
            $lessonsData = $classData?->lessons?->data;

            if (!$lessonsData) {
                continue;
            }

            foreach ($lessonsData as $lessonData) {
                $timeStartAt = Carbon::parse($lessonData->start_at->date);
                $timeEndAt = Carbon::parse($lessonData->end_at->date);

                $lessonEntity = new LessonEntity();
                $lessonEntity->fill([
                    'id' => $lessonData->id,
                    'date' => $timeStartAt->format('Y-m-d'),
                    'timeStartAt' => $timeStartAt->format('H:i'),
                    'timeEndAt' => $timeEndAt->format('H:i'),
                    'classId' => $classData->id,
                    'className' => $classData->name,
                    // ---------------------------------------------
                    // I'm too lazy to do it in js, sorry about that
                    'color' => $this->getColorFromStringFeature->handle($classData->id),
                    'dayOfWeek' => Carbon::parse($lessonData->start_at->date)->dayOfWeek,
                    'hourStart' => $timeStartAt->hour,
                    'hourEnd' => $timeEndAt->hour,
                    'duration' => $timeEndAt->diffInMinutes($timeStartAt),
                    'percentOfHourStart' => ($timeStartAt->minute / 60) * 100,
                    'percentOfHourEnd' => ($timeEndAt->minute / 60) * 100,
                ]);

                $lessonEntityCollection->push($lessonEntity);
            }
        }

        return $lessonEntityCollection;
    }
}
