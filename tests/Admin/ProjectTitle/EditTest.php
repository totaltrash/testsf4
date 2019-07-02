<?php

namespace Tests\Admin\ProjectTitle;

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
            $this->createProjectTitleFixture('Some Project Title'),
        ]);
    }

    public function testEdit()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_project_title_show', ['id' => 1]);
        $this->page->clickLink(self::EDIT_LINK);
        $this->assert->currentRoute('admin_project_title_edit', ['id' => 1]);

        $this->page->fillField('project_title_name', 'New Project Title Name');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('admin_project_title_show', ['id' => 1]);
        $this->assert->responseContains('New Project Title Name');
    }
    
    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_project_title_edit', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
