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

    protected function createContactEmailFixture(Entity\Contact $contact, array $options = [])
    {
        $options = array_merge([
            'type' => Entity\Contact\Email::TYPE_WORK,
            'email' => 'some@email.com',
        ], $options);
        
        $fixture = new Entity\Contact\Email();
        $fixture
            ->setContact($contact)
            ->setType($options['type'])
            ->setEmail($options['email'])
        ;

        return $fixture;
    }

    protected function createContactPhoneFixture(Entity\Contact $contact, array $options = [])
    {
        $options = array_merge([
            'type' => Entity\Contact\Phone::TYPE_WORK,
            'phone' => '03 5155 5555',
        ], $options);
        
        $fixture = new Entity\Contact\Phone();
        $fixture
            ->setContact($contact)
            ->setType($options['type'])
            ->setPhone($options['phone'])
        ;

        return $fixture;
    }

    protected function createContactAddressFixture(Entity\Contact $contact, array $options = [])
    {
        $options = array_merge([
            'type' => Entity\Contact\Address::TYPE_WORK,
            'address1' => 'Address 1',
            'address2' => 'Address 2',
            'address3' => 'Address 3',
            'address4' => 'Address 4',
        ], $options);
        
        $fixture = new Entity\Contact\Address();
        $fixture
            ->setContact($contact)
            ->setType($options['type'])
            ->setAddress1($options['address1'])
            ->setAddress2($options['address2'])
            ->setAddress3($options['address3'])
            ->setAddress4($options['address4'])
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
