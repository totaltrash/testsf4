<?php

namespace App\Tests\Config;

use App\Entity;
use DateTime;
use ReflectionClass;

trait FixtureFactory
{
    protected function createProjectFixture(array $options = [])
    {
        $options = array_merge([
            'type' => 'Some Project Type',
            'property' => 'Some Project Property',
            'title' => 'Some Project Title',
            'active' => true,
        ], $options);
        
        $fixture = new Entity\Project();
        $fixture
            ->setType($options['type'])
            ->setProperty($options['property'])
            ->setTitle($options['title'])
            ->setActive($options['active'])
        ;

        return $fixture;
    }
}
