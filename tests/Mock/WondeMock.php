<?php

namespace Tests\Mock;

use Mockery;
use Mockery\MockInterface;
use Wonde\Client as WondeClient;

trait WondeMock
{
    public function initWondeMock()
    {
        $wondeClientMock = Mockery::mock(WondeClient::class);

        $schoolMock = $this->initSchool($wondeClientMock);

        $this->initClasses($schoolMock);
        $this->initEmployees($schoolMock);

        return $wondeClientMock;
    }

    protected function initSchool(MockInterface $wondeClientMock): MockInterface
    {
        $schoolMock = Mockery::mock();

        $wondeClientMock->shouldReceive('school')
            ->withAnyArgs()
            ->zeroOrMoreTimes()
            ->andReturn($schoolMock);

        return $schoolMock;
    }

    protected function initClasses(MockInterface $schoolMock)
    {
        $classesMock = Mockery::mock();
        $schoolMock->classes = $classesMock;

        $classesMock->expects('get')
            ->withAnyArgs()
            ->zeroOrMoreTimes()
            ->andReturn(
                $this->getData('classes.json')
            );
    }

    protected function initEmployees(MockInterface $schoolMock)
    {
        $employeesMock = Mockery::mock();
        $schoolMock->employees = $employeesMock;

        $employeesMock->expects('all')
            ->withAnyArgs()
            ->zeroOrMoreTimes()
            ->andReturn(
                $this->getData('employees.json')
            );

        $employeesMock->expects('get')
            ->withAnyArgs()
            ->zeroOrMoreTimes()
            ->andReturn(
                $this->getData('lessons.json')
            );
    }

    protected function getData(string $filename)
    {
        $jsonDataObject = json_decode(
            file_get_contents(dirname(__DIR__, 1) . '/data/' . $filename)
        );

        return $jsonDataObject->data;
    }
}
