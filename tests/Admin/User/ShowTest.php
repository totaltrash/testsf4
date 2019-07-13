<?php

namespace Tests\Admin\User;

use Tests\Config\Web\TestCase;

class ShowTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN', 'firstName' => 'Admin', 'surname' => 'User']),
            $this->createUserFixture('user', ['firstName' => 'Some', 'surname' => 'User']),
        ]);
    }

    public function testDetail()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_user_show', ['id' => 2]);
        $this->assert->responseContains('Some User');
    }

    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_user_show', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
