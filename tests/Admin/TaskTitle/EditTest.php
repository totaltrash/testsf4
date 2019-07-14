<?php

namespace Tests\Admin\TaskTitle;

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
            $this->createTaskTitleFixture('Some Task Title'),
        ]);
    }

    public function testEdit()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_task_title_show', ['id' => 1]);
        $this->page->clickLink(self::EDIT_LINK);
        $this->assert->currentRoute('admin_task_title_edit', ['id' => 1]);

        $this->page->fillField('task_title_name', 'New Task Title Name');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('admin_task_title_show', ['id' => 1]);
        $this->assert->responseContains('New Task Title Name');
    }
    
    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_task_title_edit', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
