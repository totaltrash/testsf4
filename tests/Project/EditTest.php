<?php

namespace Tests\Project;

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
        ]);
    }

    public function testEdit()
    {
        $this->asUser('user');
        $this->visitRoute('project_show', ['id' => 1]);
        $this->page->clickLink(self::EDIT_LINK);
        $this->assert->currentRoute('project_edit', ['id' => 1]);

        $this->page->fillField('project_title', 'New Project Title');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('project_show', ['id' => 1]);
        $this->assert->responseContains('New Project Title');
    }
}
