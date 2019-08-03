<?php

namespace Tests\Contact;

use Tests\Config\Web\TestCase;

class ReferrerTest extends TestCase
{
    /** @group wip */
    public function testOrganisationReferrer()
    {
        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $organisation = $this->createOrganisationFixture(['name' => 'Some Organisation']),
            $this->createContactFixture(['firstName' => 'Some', 'surname' => 'Contact', 'organisation' => $organisation]),
        ]);

        $this->asUser('user');

        $this->visitRoute('contact_show', ['id' => 1, 'referrer' => '/organisation/1']);
        $this->assert->currentRoute('contact_show', ['id' => 1]);
        $this->page->clickLink('Back');
        $this->assert->currentRoute('organisation_show', ['id' => 1]);

        $this->visitRoute('contact_show', ['id' => 1]);
        $this->assert->currentRoute('contact_show', ['id' => 1]);
        $this->page->clickLink('Back');
        $this->assert->currentRoute('contact_index');
    }
}
