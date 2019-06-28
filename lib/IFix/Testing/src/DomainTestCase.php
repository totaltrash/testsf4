<?php

namespace Application\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use FT\Testing\FixtureLoader\FixtureLoader;
use FT\Testing\Symfony\ContainerAware;

/**
 * @todo Fix this - copied from old project
 * Local application test helpers for testing at the domain level
 *
 * Do not include FT\Testing\Assert\Assert here, use the base phpunit assert
 * that is extended by KernelTestCase
 */
abstract class DomainTestCase extends KernelTestCase
{
    use Configuration;
    use ContainerAware;

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
        $this->entityManager = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $this->fixture = new FixtureLoader($this->entityManager);
        $this->fixture->resetDatabase($this->sequences, $this->exclusions);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->entityManager = null;
        $this->fixture = null;

        parent::tearDown();
    }
}
