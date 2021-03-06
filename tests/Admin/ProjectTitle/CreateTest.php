<?php

namespace Tests\Admin\ProjectTitle;

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
        $this->visitRoute('admin_project_title_index');
        $this->page->clickLink(self::ADD_NEW_BUTTON);
        $this->assert->currentRoute('admin_project_title_new');

        $this->page->fillField('project_title_name', 'Some Project Title');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('admin_project_title_index');
        $this->assert->responseContains('Some Project Title');
    }

    public function testValidations()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_project_title_new');
        $this->page->pressButton('Save');
        $this->assert->currentRoute('admin_project_title_new');
        $this->assert->responseContains('Required field');
    }

    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_project_title_new');
        $this->assert->statusCodeEquals(403);
    }
}
