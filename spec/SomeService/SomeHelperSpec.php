<?php

namespace spec\App\SomeService;

use App\SomeService\SomeHelper;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SomeHelperSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(SomeHelper::class);
    }

    public function it_does_something()
    {
        $this->something()->shouldReturn(true);
        $this->something(true)->shouldReturn(true);
        $this->something(false)->shouldReturn(false);
    }
}
