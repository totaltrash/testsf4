<?php

namespace App\SomeService;

class SomeHelper
{
    public function something(bool $arg = null): bool
    {
        return $arg ?? true;
    }
}
