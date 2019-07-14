<?php

namespace Tests\Profile;

use Tests\Config\Web\TestCase;

class ViewTest extends TestCase
{
    const PROFILE_LINK = 'My Profile';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('user', ['firstName' => 'Some', 'surname' => 'User']),
        ]);
    }

    public function testView()
    {
        $this->asUser('user');
        $this->visitRoute('home');
        $this->page->clickLink(self::PROFILE_LINK);
        $this->assert->currentRoute('profile_index');
        $this->assert->responseContains('Some User');
    }
}
