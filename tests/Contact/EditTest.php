<?php

namespace Tests\Contact;

use Tests\Config\Web\TestCase;

class EditTest extends TestCase
{
    const EDIT_LINK = 'Edit';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('user'),
            $contact = $this->createContactFixture(['firstName' => 'Some', 'surname' => 'Contact']),
        ]);
    }

    public function testEdit()
    {
        $this->asUser('user');
        $this->visitRoute('contact_show', ['id' => 1]);
        $this->page->clickLink(self::EDIT_LINK);
        $this->assert->currentRoute('contact_edit', ['id' => 1]);

        $this->page->fillField('contact_firstName', 'New');
        $this->page->fillField('contact_surname', 'Surname');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('contact_show', ['id' => 1]);
        $this->assert->responseContains('New Surname');
    }
}
