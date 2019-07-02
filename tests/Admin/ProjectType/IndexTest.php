<?php

namespace Tests\Admin\ProjectType;

use Tests\Config\Web\TestCase;

class IndexTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
            $this->createProjectTypeFixture('Some Project Type'),
        ]);
    }

    public function testIndex()
    {
        $this->asUser('admin');
        $this->visitRoute('home');
        $this->page->clickLink('Project Types');
        $this->assert->currentRoute('admin_project_type_index');
        $this->assert->responseContains('Some Project Type');
    }

    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('home');
        $this->assert->hasNotLink('Project Types');
        $this->visitRoute('admin_project_type_index');
        $this->assert->statusCodeEquals(403);
    }
}
