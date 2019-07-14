<?php

namespace Tests\Organisation;

use Tests\Config\Web\TestCase;

class ShowTest extends TestCase
{
    public function testShow()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $organisation = $this->createOrganisationFixture(['name' => 'Some Organisation']),
        ]);

        $this->asUser('user');
        $this->visitRoute('organisation_show', ['id' => 1]);
        $this->assert->currentRoute('organisation_show', ['id' => 1]);
        $this->assert->responseContains('Some Organisation');
    }
}
