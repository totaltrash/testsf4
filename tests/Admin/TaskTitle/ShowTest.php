<?php

namespace Tests\Admin\TaskTitle;

use Tests\Config\Web\TestCase;

class ShowTest extends TestCase
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

    public function testDetail()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_task_title_show', ['id' => 1]);
        $this->assert->responseContains('Some Task Title');
    }

    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_task_title_show', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
