<?php

namespace Tests\Feature;

use App\Converters\WondeClassStudentsToStudentEntityCollectionConverter;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\Mock\WondeMock;
use Tests\TestCase;

class ClassStudentsConverterTest extends TestCase
{
    use WondeMock;

    public function testClassStudentsConverterTestResponseData(): void
    {
        // arrange
        $wondeClientMock = $this->initWondeMock();
        $class = $wondeClientMock->school(123)->classes->get(123, []);
        $wondeClassStudentsToStudentEntityCollectionConverter = App::make(WondeClassStudentsToStudentEntityCollectionConverter::class);

        // act
        $result = $wondeClassStudentsToStudentEntityCollectionConverter->handle($class);

        // assert
        $this->assertContainsEquals(
            [
                'id' => 'A1504266511',
                'forename' => "Mabon",
                'surname'  => "Pendry"
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
