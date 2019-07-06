<?php

namespace Tests\Project;

use Tests\Config\Web\TestCase;

class ShowTest extends TestCase
{
    public function testShow()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $project = $this->createProjectFixture(['title' => 'My Project']),
        ]);

        $this->asUser('user');
        $this->visitRoute('project_show', ['id' => 1]);
        $this->assert->currentRoute('project_show', ['id' => 1]);
        $this->assert->responseContains('My Project');
    }
}
