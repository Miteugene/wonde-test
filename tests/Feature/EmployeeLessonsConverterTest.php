<?php

use App\Converters\WondeEmployeeLessonsToLessonEntityCollectionConverter;
use Illuminate\Support\Facades\App;
use Tests\Mock\WondeMock;
use Tests\TestCase;

class EmployeeLessonsConverterTest extends TestCase
{
    use WondeMock;

    public function testEmployeeLessonsConverterResponseData(): void
    {
        // arrange
        $wondeClientMock = $this->initWondeMock();
        $employee = $wondeClientMock->school(123)->employees->get(123, [123], [123]);
        $employeeLessonsToLessonEntityCollectionConverter = App::make(WondeEmployeeLessonsToLessonEntityCollectionConverter::class);

        // act
        $result = $employeeLessonsToLessonEntityCollectionConverter->handle($employee);

        // assert
        $this->assertContainsEquals(
            [
                'id' => 'A1450080597',
                'date' => '2023-07-17',
                'time_start_at' => '08:15',
                'time_end_at' => '09:15',
                'class_id' => 'A1884218389',
                'class_name' => '10B/Gg1',
                'color' => 'FF6347',
                'day_of_week' => 1,
                'hour_start' => 8,
                'hour_end' => 9,
                'duration' => 60,
                'percent_of_hour_start' => 25,
                'percent_of_hour_end' => 25,
            ],
            $result->toArray()
        );
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
