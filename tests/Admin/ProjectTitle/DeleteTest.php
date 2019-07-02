<?php

namespace Tests\Admin\ProjectTitle;

use Tests\Config\Web\TestCase;

class DeleteTest extends TestCase
{
    const DELETE_LINK = 'Delete';
    const CONFIRM_BUTTON = 'Confirm Delete';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
            $this->createProjectTitleFixture('Some Project Title'),
        ]);
    }

    public function testDelete()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_project_title_show', ['id' => 1]);
        $this->page->clickLink(self::DELETE_LINK);
        $this->assert->currentRoute('admin_project_title_delete', ['id' => 1]);
        $this->page->pressButton(self::CONFIRM_BUTTON);
        $this->assert->currentRoute('admin_project_title_index');
        $this->assert->responseNotContains('Some Project Title');
    }
    
    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_project_title_delete', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
