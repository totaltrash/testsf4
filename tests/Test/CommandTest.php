<?php

namespace App\Tests\Test;

use App\Tests\Config\Command\TestCase;
use App\Command;

/** @group wip */
class CommandTest extends TestCase
{
    const COMMAND_NAME = 'app:test';

    public function testMustBeRunInProd()
    {
        $this->runTestCommand();

        $this->assert->exitCodeEquals(1);
        $this->assert->seeInConsole("This command must be run in the production environment");
    }

    // public function testImport()
    // {
    //     $this->fixture->persistEntities(array(
    //         $this->createCourseFixture('COURSE1', 'Some Course 1', 1, true, 3),
    //         $this->createCourseFixture('COURSE2', 'Some Course 2', 2, true, 4),
    //     ));

    //     $this->mockKernelEnvironment('prod');

    //     $smsCourseRepo = $this->mocker->mockService(
    //         'sms_data.course_repository',
    //         'FT\SmsDataBundle\Entity\CurriculumRepository'
    //     );
        
    //     $smsCourses = [
    //         $course1 = $this->createSmsDataCourseFixture('COURSE1', 'Some Course X', [], true, null, 3, 1),
    //         $course2 = $this->createSmsDataCourseFixture('COURSE2', 'Some Course 2', [], false, null, 4, 2),
    //         $course3 = $this->createSmsDataCourseFixture('COURSE3', 'Some Course 3', [], true, null, 6, 3),
    //     ];
    //     $smsCourseRepo->findAll()->willReturn($smsCourses);

    //     $this->runTestCommand();

    //     $this->assert->exitCodeEquals(0);
    //     $this->assert->seeInConsole("Importing unit data...\nComplete");
    //     $this->assert->seeInConsole("Importing course data...\nComplete");

    //     $this->mocker->checkPredictions();
    //     $this->assert->coursesMatch($smsCourses);
    // }

    /**
     * Run the import command
     */
    protected function runTestCommand()
    {
        $this->runCommand(self::COMMAND_NAME);
    }

    /**
     * Mock the kernel environment so it appears to be the prod environment.
     * The import needs to be run in prod as dev has lots of debugging going on.
     */
    protected function mockKernelEnvironment()
    {
        $kernel = $this->mocker->mockService('kernel', 'Symfony\Component\HttpKernel\KernelInterface');
        $kernel
            ->getEnvironment()
            ->willReturn('prod')
        ;
    }
}
