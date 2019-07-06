<?php

namespace Tests\Project;

use Tests\Config\Web\TestCase;

class CreateTest extends TestCase
{
    const ADD_NEW_BUTTON = 'Add New';

    public function setUp()
    {
        parent::setUp();

        $this->fixture->persistEntities([
            $user = $this->createUserFixture('user'),
            $this->createProjectTypeFixture('Some Project Type 2'),
            $this->createProjectTypeFixture('Some Project Type 1'),
            $this->createProjectTypeFixture('Some Project Type 3'),
            $this->createProjectTitleFixture('Some Project Title 2'),
            $this->createProjectTitleFixture('Some Project Title 1'),
            $this->createProjectTitleFixture('Some Project Title 3'),
        ]);
    }

    public function testGoToCreate()
    {
        $this->asUser('user');
        $this->visitRoute('project_index');
        $this->page->clickLink(self::ADD_NEW_BUTTON);

        $this->assert->currentRoute('project_new');
    }

    public function testCreate()
    {
        $this->asUser('user');
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
        $this->asUser('user');
        $this->visitRoute('project_new');

        $this->page->pressButton('Save');

        $this->assert->currentRoute('project_new');
        $this->assert->responseContains('Required field');
    }
}
