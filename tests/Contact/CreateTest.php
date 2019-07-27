<?php

namespace Tests\Contact;

use Tests\Config\Web\TestCase;

class CreateTest extends TestCase
{
    const ADD_NEW_BUTTON = 'Add New';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
        ]);
    }

    public function testGoToCreate()
    {
        $this->asUser('user');
        $this->visitRoute('contact_index');
        $this->page->clickLink(self::ADD_NEW_BUTTON);

        $this->assert->currentRoute('contact_new');
    }

    public function testCreate()
    {
        $this->asUser('user');
        $this->visitRoute('contact_new');

        $this->page->fillField('contact_firstName', 'Some');
        $this->page->fillField('contact_surname', 'Contact');
        $this->page->fillField('contact_organisation', 'Some Organisation');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('contact_index');
        $this->assert->responseContains('Some Contact');
        $this->assert->responseContains('Some Organisation');
    }

    public function testValidations()
    {
        $this->asUser('user');
        $this->visitRoute('contact_new');

        $this->page->pressButton('Save');

        $this->assert->currentRoute('contact_new');
        $this->assert->responseContains('should not be blank');
    }
}
