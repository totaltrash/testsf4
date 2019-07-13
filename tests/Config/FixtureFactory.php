<?php

namespace Tests\Config;

use App\Entity;
use DateTime;
use ReflectionClass;

trait FixtureFactory
{
    /**
     * @param string $username
     * @param array|string $options If a string, specifies the users role, else an array of options
     */
    protected function createUserFixture($username, $options = [])
    {
        if (is_string($options)) {
            $options = ['roles' => $options];
        }

        $options = array_merge([
            'roles' => [ 'ROLE_USER' ],
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

    protected function createTaskFixture(Entity\Project $project, array $options = [])
    {
        $options = array_merge([
            'title' => 'Some Task Title',
            'dueDate' => 'tomorrow',
            'completionDate' => 'today',
            'createdDate' => 'yesterday',
            'status' => Entity\Task::STATUS_PENDING,
        ], $options);
        
        $fixture = new Entity\Task();
        $fixture
            ->setProject($project)
            ->setTitle($options['title'])
            ->setStatus($options['status'])
            ->setCreatedDate(new DateTime($options['createdDate']))
            ->setDueDate(new DateTime($options['dueDate']))
            ->setCompletionDate(new DateTime($options['completionDate']))
        ;

        return $fixture;
    }

    protected function createProjectTypeFixture($name, array $options = [])
    {
        $fixture = new Entity\ProjectType();
        $fixture
            ->setName($name)
        ;

        return $fixture;
    }

    protected function createProjectTitleFixture($name, array $options = [])
    {
        $fixture = new Entity\ProjectTitle();
        $fixture
            ->setName($name)
        ;

        return $fixture;
    }
}
