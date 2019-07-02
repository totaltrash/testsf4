<?php

namespace Tests\Config\Command;

use Tests\Config\Command\Assert;
use Tests\Config\Configuration;
use IFix\Testing\Command\TestCase as BaseTestCase;
use IFix\Testing\FixtureLoader;
use IFix\Testing\Mocker;
use IFix\Testing\ContainerAware;

/**
 * Local application test helpers for testing in a command context
 */
abstract class TestCase extends BaseTestCase
{
    use Configuration;
    use ContainerAware;

    /**
     * @var Behat\Mink\Session
     */
    protected $session;

    /**
     * @var Behat\Mink\Element\DocumentElement
     */
    protected $page;

    /**
     * @var Assert
     */
    protected $assert;

    /**
     * @var FixtureLoader
     */
    protected $fixture;

    /**
     * @var Mocker
     */
    protected $mocker;

    /**
     * @var Doctrine\ORM\EntityManagerInterface
     */
    protected $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->entityManager = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $this->assert = new Assert($this->entityManager);
        $this->fixture = new FixtureLoader($this->entityManager);
        $this->fixture->resetDatabase($this->sequences, $this->exclusions);
        $this->mocker = new Mocker($this->getContainer());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->mocker->checkPredictions();
        $this->mocker = null;
        $this->entityManager = null;
        $this->assert = null;
        $this->fixture = null;

        parent::tearDown();
    }

    public function getAssert()
    {
        return $this->assert;
    }
}
