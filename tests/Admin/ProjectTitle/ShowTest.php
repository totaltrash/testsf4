<?php

namespace Tests\Admin\ProjectTitle;

use Tests\Config\Web\TestCase;

class ShowTest extends TestCase
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

    public function testDetail()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_project_title_show', ['id' => 1]);
        $this->assert->responseContains('Some Project Title');
    }

    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_project_title_show', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
