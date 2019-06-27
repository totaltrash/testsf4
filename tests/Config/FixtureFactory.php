<?php

namespace App\Tests\Config;

use App\Entity;
use DateTime;
use ReflectionClass;

trait FixtureFactory
{
    protected function createUserFixture($username, array $options = [])
    {
        $options = array_merge([
            'roles' => [],
            'password' => $username . 'pass',
            'email' => $username . '@email.com',
            'firstName' => 'Some',
            'surname' => 'User',
            'enabled' => true,
        ], $options);

        $options['roles'] = is_array($options['roles'])
            ? $options['roles']
            : [$options['roles']]
        ;
        
        $encoder = $this->getContainer()->get('security.password_encoder');
        $fixture =  new Entity\User();
        $fixture
            ->setUsername($username)
            ->setPassword($encoder->encodePassword($fixture, $options['password']))
            ->setFirstName($options['firstName'])
            ->setSurname($options['surname'])
            ->setEmail($options['email'])
            ->setEnabled($options['enabled'])
            ->setRoles($options['roles'])
        ;

        return $fixture;
    }

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
