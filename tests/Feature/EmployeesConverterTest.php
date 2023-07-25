<?php

namespace Tests\Feature;

use App\Converters\WondeEmployeesToEmployeeEntityCollectionConverter;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\Mock\WondeMock;
use Tests\TestCase;

class EmployeesConverterTest extends TestCase
{
    use WondeMock;

    public function testEmployeesConverterResponseData(): void
    {
        // arrange
        $wondeClientMock = $this->initWondeMock();
        $employees = $wondeClientMock->school(123)->employees->all([123], [123]);
        $employeesToEmployeeEntityCollectionConverter = App::make(WondeEmployeesToEmployeeEntityCollectionConverter::class);

        // act
        $result = $employeesToEmployeeEntityCollectionConverter->handle($employees);

        // assert
        $this->assertContainsEquals(
            [
                'id' => 'A500460806',
                'title' => 'Mrs',
                'forename' => 'Selina',
                'surname' => 'Andrews',
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
