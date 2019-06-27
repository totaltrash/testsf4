<?php

namespace App\SomeService;

class SomeService
{
    private $someHelper;

    public function __construct(SomeHelper $someHelper)
    {
        $this->someHelper = $someHelper;
    }

    public function doIt(bool $flag)
    {
        return $this->someHelper->something($flag);
    }

    public function breakIt()
    {
        throw new \Exception('broke it');
    }

    public function doubleIt(int $number)
    {
        return $number * 2;
    }
}
