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

    protected function createOrganisationFixture(array $options = [])
    {
        $options = array_merge([
            'name' => 'Some Organisation',
            'active' => true,
        ], $options);
        
        $fixture = new Entity\Organisation();
        $fixture
            ->setName($options['name'])
            ->setActive($options['active'])
        ;

        return $fixture;
    }

    protected function createContactFixture(array $options = [])
    {
        $options = array_merge([
            'firstName' => 'Some',
            'surname' => 'Contact',
            'notes' => '',
            'organisation' => null,
        ], $options);
        
        $fixture = new Entity\Contact();
        $fixture
            ->setFirstName($options['firstName'])
            ->setSurname($options['surname'])
            ->setNotes($options['notes'])
            ->setOrganisation($options['organisation'])
        ;

        return $fixture;
    }

    protected function createTaskFixture(Entity\Project $project, array $options = [])
    {
        $options = array_merge([
            'title' => 'Some Task Title',
            'dueDate' => 'tomorrow',
            'completionDate' => null,
            'createdDate' => 'yesterday',
            'status' => Entity\Task::STATUS_PENDING,
        ], $options);
        
        $fixture = new Entity\Task($project);

        if ($options['status'] !== Entity\Task::STATUS_PENDING) {
            $fixture->setStatus($options['status']);
        }

        $fixture
            ->setTitle($options['title'])
            ->setCreatedDate(new DateTime($options['createdDate']))
            ->setDueDate(new DateTime($options['dueDate']))
            ->setCompletionDate(
                $options['completionDate']
                ? new DateTime($options['completionDate'])
                : null
            )
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

    protected function createTaskTitleFixture($name, array $options = [])
    {
        $fixture = new Entity\TaskTitle();
        $fixture
            ->setName($name)
        ;

        return $fixture;
    }
}
