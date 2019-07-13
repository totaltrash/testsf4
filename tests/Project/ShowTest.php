<?php

namespace Tests\Project;

use Tests\Config\Web\TestCase;

/** @group wip */
class ShowTest extends TestCase
{
    public function testShow()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $project = $this->createProjectFixture(['title' => 'My Project']),
            $this->createTaskFixture($project, ['title' => 'Some Task']),
            $this->createTaskFixture($project),
        ]);

        $this->asUser('user');
        $this->visitRoute('project_show', ['id' => 1]);
        $this->assert->currentRoute('project_show', ['id' => 1]);
        $this->assert->responseContains('My Project');
        $this->assert->responseContains('Some Task');
    }
}
