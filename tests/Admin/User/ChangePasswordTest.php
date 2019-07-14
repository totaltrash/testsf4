<?php

namespace Tests\Admin\User;

use Tests\Config\Web\TestCase;

class ChangePasswordTest extends TestCase
{
    const EDIT_LINK = 'Change User Password';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
        ]);
    }

    public function testChangePassword()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_user_show', ['id' => 2]);
        $this->assert->responseContains('Some User');
        $this->page->clickLink(self::EDIT_LINK);
        $this->assert->currentRoute('admin_user_change_password', ['id' => 2]);
        $this->page->fillField('Password', 'MyNewPassword');
        $this->page->fillField('Confirm password', 'MyNewPassword');
        $this->page->pressButton('Save');
        $this->assert->currentRoute('admin_user_show', ['id' => 2]);

        // check new password
        $this->page->clickLink('Logout');
        $this->assert->currentRoute('security_login');
        $this->page->fillField('username', 'user');
        $this->page->fillField('password', 'MyNewPassword');
        $this->page->pressButton('Sign in');
        $this->assert->currentRoute('home');
    }
    
    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_user_change_password', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
