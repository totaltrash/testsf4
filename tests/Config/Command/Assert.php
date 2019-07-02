<?php

namespace Tests\Config\Command;

use IFix\Testing\Command\Assert as BaseAssert;
use Symfony\Component\Console\Tester\CommandTester;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Local application assertions for testing commands
 *
 * Store application specific assertions here. Alternatively,
 * set up a trait for each command and use them here.
 */
class Assert extends BaseAssert
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CommandTester
     */
    private $tester;

    /**
     * Constructor
     *
     * @param   EntityManagerInterface      $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritDoc}
     */
    public function setTester(CommandTester $tester)
    {
        $this->tester = $tester;
    }

    /**
     * {@inheritDoc}
     */
    public function getTester()
    {
        return $this->tester;
    }
}
