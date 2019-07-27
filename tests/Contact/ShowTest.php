<?php

namespace Tests\Contact;

use Tests\Config\Web\TestCase;

use App\Entity\Contact;

class ShowTest extends TestCase
{
    public function testShow()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $contact = $this->createContactFixture(['firstName' => 'Some', 'surname' => 'Contact']),
            $this->createContactEmailFixture($contact, ['email' => 'work@email.com', 'type' => Contact\Email::TYPE_WORK]),
            $this->createContactEmailFixture($contact, ['email' => 'home@email.com', 'type' => Contact\Email::TYPE_HOME]),
            $this->createContactEmailFixture($contact, ['email' => 'personal@email.com', 'type' => Contact\Email::TYPE_PERSONAL]),
            $this->createContactEmailFixture($contact, ['email' => 'other@email.com', 'type' => Contact\Email::TYPE_OTHER]),
            $this->createContactPhoneFixture($contact, ['phone' => '03 5155 5555', 'type' => Contact\Phone::TYPE_WORK]),
            $this->createContactAddressFixture($contact, ['address1' => '54 My Address', 'type' => Contact\Address::TYPE_WORK]),
        ]);

        $this->asUser('user');
        $this->visitRoute('contact_show', ['id' => 1]);
        $this->assert->currentRoute('contact_show', ['id' => 1]);
        $this->assert->responseContains('Some Contact');
        $this->assert->responseContains('home@email.com');
        $this->assert->responseContains('03 5155 5555');
        $this->assert->responseContains('54 My Address');
    }
}
