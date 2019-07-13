<?php

namespace Tests\Admin\User;

use Tests\Config\Web\TestCase;

class EditTest extends TestCase
{
    const EDIT_LINK = 'Edit';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
        ]);
    }

    public function testEdit()
    {
        $this->asUser('admin');
        $this->visitRoute('admin_user_show', ['id' => 1]);
        $this->page->clickLink(self::EDIT_LINK);
        $this->assert->currentRoute('admin_user_edit', ['id' => 1]);

        $this->page->fillField('user_firstName', 'New');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('admin_user_show', ['id' => 1]);
        $this->assert->responseContains('New User');
    }
    
    public function testNotPermitted()
    {
        $this->asUser('user');
        $this->visitRoute('admin_user_edit', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
