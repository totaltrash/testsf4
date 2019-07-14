<?php

namespace Tests\Organisation;

use Tests\Config\Web\TestCase;

class EditTest extends TestCase
{
    const EDIT_LINK = 'Edit';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('user'),
            $organisation = $this->createOrganisationFixture(['name' => 'Some Organisation']),
        ]);
    }

    public function testEdit()
    {
        $this->asUser('user');
        $this->visitRoute('organisation_show', ['id' => 1]);
        $this->page->clickLink(self::EDIT_LINK);
        $this->assert->currentRoute('organisation_edit', ['id' => 1]);

        $this->page->fillField('organisation_name', 'New Organisation');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('organisation_show', ['id' => 1]);
        $this->assert->responseContains('New Organisation');
    }
}
