<?php

namespace Tests\Organisation;

use Tests\Config\Web\TestCase;

class DeleteTest extends TestCase
{
    const DELETE_LINK = 'Delete Organisation';
    const CONFIRM_BUTTON = 'Confirm Delete';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $this->createUserFixture('admin', ['roles' => 'ROLE_ADMIN']),
            $this->createUserFixture('user'),
            $organisation = $this->createOrganisationFixture(['name' => 'Some Organisation']),
        ]);
    }

    public function testDelete()
    {
        $this->asUser('admin');
        $this->visitRoute('organisation_show', ['id' => 1]);
        $this->page->clickLink(self::DELETE_LINK);
        $this->assert->currentRoute('organisation_delete', ['id' => 1]);
        $this->page->pressButton(self::CONFIRM_BUTTON);
        $this->assert->currentRoute('organisation_index');
        $this->assert->responseNotContains('Some Organisation');
    }

    public function testOnlyAdminsCanDelete()
    {
        $this->asUser('user');
        $this->visitRoute('organisation_show', ['id' => 1]);
        $this->assert->hasNotLink(self::DELETE_LINK);

        $this->visitRoute('organisation_delete', ['id' => 1]);
        $this->assert->statusCodeEquals(403);
    }
}
