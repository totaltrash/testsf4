<?php

namespace Tests\Admin\ProjectType;

use Tests\Config\Web\TestCase;

class CreateTest extends TestCase
{
    const ADD_NEW_BUTTON = 'Add New';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
        ]);
    }

    public function testCreate()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_project_type_index');
        $this->page->clickLink(self::ADD_NEW_BUTTON);
        $this->assert->currentRoute('admin_project_type_new');

        $this->page->fillField('project_type_name', 'Some Project Type');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('admin_project_type_index');
        $this->assert->responseContains('Some Project Type');
    }

    public function testValidations()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_project_type_new');
        $this->page->pressButton('Save');
        $this->assert->currentRoute('admin_project_type_new');
        $this->assert->responseContains('Required field');
    }

    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_project_type_new');
        $this->assert->statusCodeEquals(403);
    }
}
