<?php

namespace Tests\Config\Web;

use Tests\Config\Web\Assert;
use Tests\Config\Configuration;
use IFix\Testing\Web\TestCase as BaseWebTestCase;
use IFix\Testing\FixtureLoader;
use IFix\Testing\Mocker;

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

        $this->session = $this->getSession();
        $this->page = $this->session->getPage();
        $this->assert = new Assert($this->session);
        $this->entityManager = $this->getContainer()->get('doctrine.orm.default_entity_manager');
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
        $this->session = null;
        $this->page = null;
        $this->entityManager = null;
        $this->assert = null;
        $this->fixture = null;

        parent::tearDown();
    }

    protected function asUser($username)
    {
        $user = $this->entityManager->getRepository('App:User')->findOneByUsername($username);
        if ($user === null) {
            throw new \Exception(sprintf('User [%s] not found', $username));
        }
        $this->setSessionAuthenticatedUser($user);
    }

    // protected function asServerAuthenticatedUser($username)
    // {
    //     $this->setServerAuthenticatedUsername($username);
    // }
}
