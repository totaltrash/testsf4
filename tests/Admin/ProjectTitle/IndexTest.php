<?php

namespace Tests\Admin\ProjectTitle;

use Tests\Config\Web\TestCase;

class IndexTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
            $this->createProjectTitleFixture('Some Project Title'),
        ]);
    }

    public function testIndex()
    {
        $this->asUser('admin');
        $this->visitRoute('home');
        $this->page->clickLink('Project Titles');
        $this->assert->currentRoute('admin_project_title_index');
        $this->assert->responseContains('Some Project Title');
    }

    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('home');
        $this->assert->hasNotLink('Project Titles');
        $this->visitRoute('admin_project_title_index');
        $this->assert->statusCodeEquals(403);
    }
}
