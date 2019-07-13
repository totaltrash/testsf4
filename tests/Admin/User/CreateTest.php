<?php

namespace Tests\Admin\User;

use Tests\Config\Web\TestCase;

class CreateTest extends TestCase
{
    const ADD_NEW_BUTTON = 'Add New';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $admin = $this->createUserFixture('admin', 'ROLE_ADMIN'),
            $user = $this->createUserFixture('user', 'ROLE_USER'),
        ]);
    }

    public function testGoToCreate()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_user_index');
        $this->page->clickLink(self::ADD_NEW_BUTTON);

        $this->assert->currentRoute('admin_user_new');
    }

    public function testCreate()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_user_new');

        $this->page->fillField('Username', 'someusername');
        $this->page->fillField('Password', 'SomePass');
        $this->page->fillField('Confirm password', 'SomePass');
        $this->page->fillField('First name', 'Some');
        $this->page->fillField('Surname', 'User');
        $this->page->fillField('Email', 'some@email.com');
        $this->page->checkField('Enabled');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('admin_user_index');
        $this->assert->responseContains('Some User');
    }

    public function testValidations()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_user_new');

        $this->page->pressButton('Save');

        $this->assert->currentRoute('admin_user_new');
        $this->assert->responseContains('must not be blank');
    }
}
