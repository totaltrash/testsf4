<?php

namespace Tests\Contact;

use Tests\Config\Web\TestCase;

class DeleteTest extends TestCase
{
    const DELETE_LINK = 'Delete Contact';
    const CONFIRM_BUTTON = 'Confirm Delete';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', 'ROLE_ADMIN'),
            $this->createUserFixture('user'),
            $contact = $this->createContactFixture(['firstName' => 'Some', 'surname' => 'Contact']),
        ]);
    }

    public function testDelete()
    {
        $this->asUser('admin');
        $this->visitRoute('contact_show', ['id' => 1]);
        $this->page->clickLink(self::DELETE_LINK);
        $this->assert->currentRoute('contact_delete', ['id' => 1]);
        $this->page->pressButton(self::CONFIRM_BUTTON);
        $this->assert->currentRoute('contact_index');
        $this->assert->responseNotContains('Some Contact');
    }

    public function testOnlyAdminsCanDelete()
    {
        $this->asUser('user');
        $this->visitRoute('contact_show', ['id' => 1]);
        $this->assert->hasNotLink(self::DELETE_LINK);

        $this->visitRoute('contact_delete', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
