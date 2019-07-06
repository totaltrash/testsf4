<?php

namespace Tests\Project;

use Tests\Config\Web\TestCase;

class DeleteTest extends TestCase
{
    const DELETE_LINK = 'Delete';
    const CONFIRM_BUTTON = 'Confirm Delete';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('user'),
            $project = $this->createProjectFixture(['title' => 'My Project']),
        ]);
    }

    public function testDelete()
    {
        $this->asUser('user');
        $this->visitRoute('project_show', ['id' => 1]);
        $this->page->clickLink(self::DELETE_LINK);
        $this->assert->currentRoute('project_delete', ['id' => 1]);
        $this->page->pressButton(self::CONFIRM_BUTTON);
        $this->assert->currentRoute('project_index');
        $this->assert->responseNotContains('My Project');
    }
}
