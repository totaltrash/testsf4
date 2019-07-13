<?php

namespace Tests\Security;

use Tests\Config\Web\TestCase;

class LoginTest extends TestCase
{
    public function testLogin()
    {
        $this->fixture->persistEntities([
            $this->createUserFixture('auser', ['firstName' => 'Alan']),
        ]);

        $page = $this->getPage();

        $this->visitRoute('home');
        $this->assert->currentRoute('security_login');

        $page->fillField('username', 'auser');
        $page->fillField('password', 'auserpass');
        $page->pressButton('Sign in');
        $this->assert->currentRoute('home');
        $this->assert->responseContains('Hello Alan');

        //logout
        $page->clickLink('Logout');
        $this->assert->currentRoute('security_login');
    }
}
