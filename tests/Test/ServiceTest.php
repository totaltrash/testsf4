<?php

namespace Tests\Test;

use Tests\Config\Web\TestCase;
use Prophecy\Argument;

class ServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
        ]);
    }

    public function testWithoutMock()
    {
        $this->asUser('user');
        $this->visitRoute('test_service');
        $this->assert->currentRoute('test_service');
        $this->assert->responseContains('double(128) = 256');
    }

    public function testWithMock()
    {
        $someService = $this->mocker->mockService('App\SomeService\SomeService');
        $someService->doubleIt(Argument::any())->shouldBeCalled()->willReturn(333);
        
        //do it
        $this->asUser('user');
        $this->visitRoute('test_service');
        $this->assert->currentRoute('test_service');
        $this->assert->responseNotContains('double(128) = 256');
        $this->assert->responseContains('double(128) = 333');
    }

    public function testAgainWithoutMock()
    {
        $this->asUser('user');
        $this->visitRoute('test_service');
        $this->assert->currentRoute('test_service');
        $this->assert->responseContains('double(128) = 256');
    }
}
