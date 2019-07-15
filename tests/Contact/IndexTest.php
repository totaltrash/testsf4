<?php

namespace Tests\Contact;

use Tests\Config\Web\TestCase;

class IndexTest extends TestCase
{
    public function testIndex()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $contact = $this->createContactFixture(['firstName' => 'Some', 'surname' => 'Contact']),
        ]);

        $this->asUser('user');
        $this->visitRoute('home');
        $this->page->clickLink('Contacts');
        $this->assert->currentRoute('contact_index');
        $this->assert->responseContains('Some Contact');
    }
}
