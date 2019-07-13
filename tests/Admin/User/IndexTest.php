<?php

namespace Tests\Admin\User;

use Tests\Config\Web\TestCase;

class IndexTest extends TestCase
{
    const USER_LINK = 'User Management';

    public function setUp()
    {
        parent::setUp();
        
        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN', 'firstName' => 'Admin', 'surname' => 'User']),
            $this->createUserFixture('user', ['firstName' => 'Some', 'surname' => 'User']),
        ]);
    }

    public function testIndex()
    {
        $this->asUser('admin');
        $this->visitRoute('home');
        $this->page->clickLink(self::USER_LINK);
        $this->assert->currentRoute('admin_user_index');
        $this->assert->responseContains('Some');
    }

    public function testPermissions()
    {
        $this->asUser('user');
        $this->visitRoute('home');
        $this->assert->hasNotLink(self::USER_LINK);

        $this->visitRoute('admin_user_index');
        $this->assert->statusCodeEquals(403);
    }
}
