<?php

namespace Tests\Contact;

use Tests\Config\Web\TestCase;

class ShowTest extends TestCase
{
    public function testShow()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $contact = $this->createContactFixture(['firstName' => 'Some', 'surname' => 'Contact']),
        ]);

        $this->asUser('user');
        $this->visitRoute('contact_show', ['id' => 1]);
        $this->assert->currentRoute('contact_show', ['id' => 1]);
        $this->assert->responseContains('Some Contact');
    }
}
