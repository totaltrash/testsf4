<?php

namespace Tests\Organisation;

use Tests\Config\Web\TestCase;

class IndexTest extends TestCase
{
    public function testIndex()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $organisation = $this->createOrganisationFixture(['name' => 'Some Organisation']),
        ]);

        $this->asUser('user');
        $this->visitRoute('home');
        $this->page->clickLink('Organisations');
        $this->assert->currentRoute('organisation_index');
        $this->assert->responseContains('Some Organisation');
    }
}
