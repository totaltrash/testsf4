<?php

namespace App\Tests\Test;

use App\Tests\Config\Web\TestCase;
use Prophecy\Argument;

/** @group wip */
class ServiceTest extends TestCase
{
    public function testWithoutMock()
    {
        $this->visitRoute('test_service');
        $this->assert->currentRoute('test_service');
        $this->assert->responseContains('double(128) = 256');
    }

    public function testWithMock()
    {
        $someService = $this->mocker->mockService('App\SomeService\SomeService');
        $someService->doubleIt(Argument::any())->shouldBeCalled()->willReturn(333);

        //do it
        $this->visitRoute('test_service');
        $this->assert->currentRoute('test_service');
        $this->assert->responseNotContains('double(128) = 256');
        $this->assert->responseContains('double(128) = 333');
    }

    public function testAgainWithoutMock()
    {
        $this->visitRoute('test_service');
        $this->assert->currentRoute('test_service');
        $this->assert->responseContains('double(128) = 256');
    }
}
