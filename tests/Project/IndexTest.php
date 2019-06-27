<?php

namespace App\Tests\Project;

use App\Tests\Config\Web\TestCase;

class IndexTest extends TestCase
{
    public function testIndex()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $project = $this->createProjectFixture(['title' => 'My Project']),
        ]);

        $this->asUser('user');
        $this->visitRoute('project_index');
        $this->assert->currentRoute('project_index');
        $this->assert->responseContains('My Project');
    }
}
