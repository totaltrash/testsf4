<?php

namespace Tests\Task;

use Tests\Config\Web\TestCase;

class EditTest extends TestCase
{
    const EDIT_LINK = 'Edit';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('user'),
            $project = $this->createProjectFixture(['title' => 'My Project']),
            $this->createTaskFixture($project, ['title' => 'Some Task']),
        ]);
    }

    public function testEdit()
    {
        $this->asUser('user');
        $this->visitRoute('task_show', ['id' => 1]);
        $this->page->clickLink(self::EDIT_LINK);
        $this->assert->currentRoute('task_edit', ['id' => 1]);

        $this->page->fillField('task_title', 'New Task Title');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('task_show', ['id' => 1]);
        $this->assert->responseContains('New Task Title');
    }
}
