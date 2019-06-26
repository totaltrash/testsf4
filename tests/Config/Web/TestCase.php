<?php

namespace App\Tests\Config\Web;

use App\Tests\Config\Web\Assert;
use App\Tests\Config\Configuration;
use Ifs\TestingBundle\Web\TestCase as BaseWebTestCase;
use Ifs\TestingBundle\FixtureLoader;

/**
 * Local application test helpers for testing in a web context
 */
abstract class TestCase extends BaseWebTestCase
{
    use Configuration;

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
     * @var Doctrine\ORM\EntityManagerInterface
     */
    protected $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->session = $this->getSession();
        $this->page = $this->session->getPage();
        $this->assert = new Assert($this->session);
        $this->entityManager = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $this->fixture = new FixtureLoader($this->entityManager);
        $this->fixture->resetDatabase($this->sequences, $this->exclusions);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->session = null;
        $this->page = null;
        $this->entityManager = null;
        $this->assert = null;
        $this->fixture = null;

        parent::tearDown();
    }

    protected function enableProfiler()
    {
        $this->getSymfonyDriver()->getClient()->enableProfiler();
    }
}