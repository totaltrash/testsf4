<?php

namespace Tests\Organisation;

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
        $this->visitRoute('organisation_index');
        $this->page->clickLink(self::ADD_NEW_BUTTON);

        $this->assert->currentRoute('organisation_new');
    }

    public function testCreate()
    {
        $this->asUser('user');
        $this->visitRoute('organisation_new');

        $this->page->fillField('organisation_name', 'Some Organisation');
        $this->page->checkField('organisation_active');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('organisation_index');
        $this->assert->responseContains('Some Organisation');
    }

    public function testValidations()
    {
        $this->asUser('user');
        $this->visitRoute('organisation_new');

        $this->page->pressButton('Save');

        $this->assert->currentRoute('organisation_new');
        $this->assert->responseContains('should not be blank');
    }
}
