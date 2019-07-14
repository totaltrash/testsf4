<?php

namespace Tests\Task;

use Tests\Config\Web\TestCase;

class ShowTest extends TestCase
{
    public function testShow()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $project = $this->createProjectFixture(),
            $this->createTaskFixture($project, ['title' => 'Some Task']),
        ]);

        $this->asUser('user');
        $this->visitRoute('project_show', ['id' => 1]);
        $this->assert->currentRoute('project_show', ['id' => 1]);
        $this->assert->responseContains('Some Task');
    }
}
