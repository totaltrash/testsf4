<?php

namespace Tests\Task;

use Tests\Config\Web\TestCase;
use App\Entity\Task;

/** @group wip */
class ChangeStatusTest extends TestCase
{
    public function testChangeStatus()
    {
        $this->fixture->persistEntities([
            $this->createUserFixture('user'),
            $project = $this->createProjectFixture(),
            $this->createTaskFixture($project, ['status' => Task::STATUS_PENDING]),
        ]);

        $this->asUser('user');
        $this->visitRoute('task_show', ['id' => 1]);
        $this->assert->elementContains('css', '.task-detail-status', 'Pending');

        $this->page->clickLink('Completed');
        $this->assert->currentRoute('task_show', ['id' => 1]);
        $this->assert->elementContains('css', '.task-detail-status', 'Completed');
    }
}
