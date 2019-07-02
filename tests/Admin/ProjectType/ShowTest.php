<?php

namespace Tests\Admin\ProjectType;

use Tests\Config\Web\TestCase;

class ShowTest extends TestCase
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

    public function testDetail()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_project_type_show', ['id' => 1]);
        $this->assert->responseContains('Some Project Type');
    }

    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_project_type_show', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
