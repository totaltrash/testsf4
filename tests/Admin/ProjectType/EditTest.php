<?php

namespace Tests\Admin\ProjectType;

use Tests\Config\Web\TestCase;

class EditTest extends TestCase
{
    const EDIT_LINK = 'Edit';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
            $this->createProjectTypeFixture('Some Project Type'),
        ]);
    }

    public function testEdit()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_project_type_show', ['id' => 1]);
        $this->page->clickLink(self::EDIT_LINK);
        $this->assert->currentRoute('admin_project_type_edit', ['id' => 1]);

        $this->page->fillField('project_type_name', 'New Project Type Name');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('admin_project_type_show', ['id' => 1]);
        $this->assert->responseContains('New Project Type Name');
    }
    
    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_project_type_edit', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
