<?php

namespace spec\App\SomeService;

use App\SomeService\SomeService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\SomeService\SomeHelper;

class SomeServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(SomeService::class);
    }

    public function let(SomeHelper $helper)
    {
        $this->beConstructedWith($helper);
    }

    public function it_does_it($helper)
    {
        $helper->something(true)->shouldBeCalled()->willReturn(true);

        $this->doIt(true)->shouldReturn(true);
    }

    public function it_doubles_it($helper)
    {
        $this->doubleIt(128)->shouldReturn(256);
    }

    public function it_breaks_it()
    {
        $this->shouldThrow(\Exception::class)->duringBreakIt();
    }
}
