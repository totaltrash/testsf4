<?php

namespace spec\App\SomeService;

use App\SomeService\SomeService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\SomeService\SomeHelper;

class SomeServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SomeService::class);
    }

    function let(SomeHelper $helper)
    {
        $this->beConstructedWith($helper);
    }

    function it_does_it($helper)
    {
        $helper->something(true)->shouldBeCalled()->willReturn(true);

        $this->doIt(true)->shouldReturn(true);
    }

    function it_doubles_it($helper)
    {
        $this->doubleIt(128)->shouldReturn(256);
    }

    function it_breaks_it()
    {
        $this->shouldThrow(\Exception::class)->duringBreakIt();
    }
}
