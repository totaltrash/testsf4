<?php

namespace Tests\Project;

use Tests\Config\Web\TestCase;

class AddTaskTest extends TestCase
{
    const ADD_TASK_LINK = 'Add New Task';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('user'),
            $project = $this->createProjectFixture(['title' => 'My Project']),
            $taskTitle = $this->createTaskTitleFixture('Some Task Title'),
        ]);
    }

    public function testAddTask()
    {
        $this->asUser('user');
        $this->visitRoute('project_show', ['id' => 1]);
        $this->page->clickLink(self::ADD_TASK_LINK);
        $this->assert->currentRoute('project_add_task', ['id' => 1]);
        $this->assert->responseContains('Some Task Title');

        $this->page->fillField('task_title', 'New Task Title');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('project_show', ['id' => 1]);
        $this->assert->responseContains('New Task Title');
    }
}
