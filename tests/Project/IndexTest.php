<?php

namespace Tests\Project;

use Tests\Config\Web\TestCase;

class IndexTest extends TestCase
{
    public function testIndex()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $project = $this->createProjectFixture(['title' => 'My Project']),
        ]);

        $this->asUser('user');
        $this->visitRoute('home');
        $this->page->clickLink('Projects');
        $this->assert->currentRoute('project_index');
        $this->assert->responseContains('My Project');
    }
}
