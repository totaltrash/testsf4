<?php

namespace Tests\Profile;

use Tests\Config\Web\TestCase;

class ChangePasswordTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('user'),
        ]);
    }

    public function testChangePassword()
    {
        $this->asUser('user');
        $this->visitRoute('profile_index');
        $this->page->clickLink('Change Password');
        $this->assert->currentRoute('profile_change_password');
        $this->page->fillField('Password', 'MyNewPassword');
        $this->page->fillField('Confirm password', 'MyNewPassword');
        $this->page->pressButton('Submit');
        $this->assert->currentRoute('profile_index');

        // check new password
        $this->page->clickLink('Logout');
        $this->assert->currentRoute('security_login');
        $this->page->fillField('username', 'user');
        $this->page->fillField('password', 'MyNewPassword');
        $this->page->pressButton('Sign in');
        $this->assert->currentRoute('home');
    }

    /** @dataProvider passwordProvider */
    public function testValidations($password, $confirmPassword, $expectedMessage)
    {
        $this->asUser('user');
        $this->visitRoute('profile_change_password');
        $this->page->fillField('Password', $password);
        $this->page->fillField('Confirm password', $confirmPassword);
        $this->page->pressButton('Submit');
        $this->assert->currentRoute('profile_change_password');
        $this->assert->responseContains($expectedMessage);
    }

    public function passwordProvider()
    {
        return [
            ['', '', 'Password must not be blank'],
            ['Shorty1', 'Shorty1', 'Password is too short'],
            ['NewPassword', 'WrongPassword', 'The password fields must match'],
        ];
    }
}
