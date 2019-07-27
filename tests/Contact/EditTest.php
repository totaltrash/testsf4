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
            $organisation1 = $this->createOrganisationFixture(['name' => 'Organisation 1']),
            $organisation2 = $this->createOrganisationFixture(['name' => 'Organisation 2']),
            $organisation3 = $this->createOrganisationFixture(['name' => 'Organisation 3', 'active' => false]),
            $contact = $this->createContactFixture([
                'firstName' => 'Some',
                'surname' => 'Contact',
                'organisation' => $organisation1,
            ]),
        ]);
    }

    public function testEdit()
    {
        $this->asUser('user');
        $this->visitRoute('contact_show', ['id' => 1]);
        $this->assert->responseContains('Some Contact');
        $this->assert->responseContains('Organisation 1');

        $this->page->clickLink(self::EDIT_LINK);
        $this->assert->currentRoute('contact_edit', ['id' => 1]);
        $this->assert->responseNotContains('Organisation 3');

        $this->page->fillField('contact_firstName', 'New');
        $this->page->fillField('contact_surname', 'Surname');
        $this->page->selectFieldOption('contact_organisation', 'Organisation 2');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('contact_show', ['id' => 1]);
        $this->assert->responseContains('New Surname');
        $this->assert->responseContains('Organisation 2');
    }
}
