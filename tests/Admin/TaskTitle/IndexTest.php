<?php

namespace Tests\Admin\TaskTitle;

use Tests\Config\Web\TestCase;

class IndexTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
            $this->createTaskTitleFixture('Some Task Title'),
        ]);
    }

    public function testIndex()
    {
        $this->asUser('admin');
        $this->visitRoute('home');
        $this->page->clickLink('Task Titles');
        $this->assert->currentRoute('admin_task_title_index');
        $this->assert->responseContains('Some Task Title');
    }

    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('home');
        $this->assert->hasNotLink('Task Titles');
        $this->visitRoute('admin_task_title_index');
        $this->assert->statusCodeEquals(403);
    }
}
