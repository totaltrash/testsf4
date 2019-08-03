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
            $this->createContactFixture(['firstName' => 'Some', 'surname' => 'Contact', 'organisation' => $organisation]),
            $this->createContactFixture(['firstName' => 'Other', 'surname' => 'Contact', 'organisation' => null]),
        ]);

        $this->asUser('user');
        $this->visitRoute('organisation_show', ['id' => 1]);
        $this->assert->currentRoute('organisation_show', ['id' => 1]);
        $this->assert->responseContains('Some Organisation');
        $this->assert->responseContains('Some Contact');
        $this->assert->responseNotContains('Other Contact');
    }
}
