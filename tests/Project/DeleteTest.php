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
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
            $project = $this->createProjectFixture(['title' => 'My Project']),
        ]);
    }

    public function testDelete()
    {
        $this->asUser('admin');
        $this->visitRoute('project_show', ['id' => 1]);
        $this->page->clickLink(self::DELETE_LINK);
        $this->assert->currentRoute('project_delete', ['id' => 1]);
        $this->page->pressButton(self::CONFIRM_BUTTON);
        $this->assert->currentRoute('project_index');
        $this->assert->responseNotContains('My Project');
    }

    public function testOnlyAdminsCanDelete()
    {
        $this->asUser('user');
        $this->visitRoute('project_show', ['id' => 1]);
        $this->assert->hasNotLink(self::DELETE_LINK);

        $this->visitRoute('project_delete', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
