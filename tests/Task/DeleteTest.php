<?php

namespace Tests\Task;

use Tests\Config\Web\TestCase;

class DeleteTest extends TestCase
{
    const DELETE_LINK = 'Delete Task';
    const CONFIRM_BUTTON = 'Confirm Delete';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
            $project = $this->createProjectFixture(),
            $task = $this->createTaskFixture($project, ['title' => 'Some Task']),
        ]);
    }

    public function testDelete()
    {
        $this->asUser('admin');
        $this->visitRoute('task_show', ['id' => 1]);
        $this->page->clickLink(self::DELETE_LINK);
        $this->assert->currentRoute('task_delete', ['id' => 1]);
        $this->page->pressButton(self::CONFIRM_BUTTON);
        $this->assert->currentRoute('project_show', ['id' => 1]);
        $this->assert->responseNotContains('My Task');
    }

    public function testOnlyAdminsCanDelete()
    {
        $this->asUser('user');
        $this->visitRoute('task_show', ['id' => 1]);
        $this->assert->hasNotLink(self::DELETE_LINK);

        $this->visitRoute('task_delete', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
