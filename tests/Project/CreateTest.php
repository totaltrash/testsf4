<?php

namespace App\Tests\Project;

use App\Tests\Config\Web\TestCase;

/** @group wip */
class CreateTest extends TestCase
{
    public function testGoToCreate()
    {
        $this->visitRoute('project_index');

        $this->page->clickLink('Create new');

        $this->assert->currentRoute('project_new');
    }

    public function testCreate()
    {
        $this->visitRoute('project_new');

        $this->page->fillField('project_type', 'Some Project Type');
        $this->page->fillField('project_property', 'Some Project Property');
        $this->page->fillField('project_title', 'Some Project Title');
        $this->page->checkField('project_active');
        $this->page->pressButton('Save');

        $this->assert->currentRoute('project_index');
        $this->assert->responseContains('Some Project Title');
    }

    public function testValidations()
    {
        $this->visitRoute('project_new');

        $this->page->pressButton('Save');

        $this->assert->currentRoute('project_new');
        $this->assert->responseContains('Required field');
    }
}
