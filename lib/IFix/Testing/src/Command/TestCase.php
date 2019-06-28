<?php

namespace IFix\Testing\Command;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Generic test helpers for use in a command context.
 */
abstract class TestCase extends KernelTestCase
{
    /**
     * Run the given command.
     *
     * @param string  $name
     * @param array   $arguments
     */
    public function runCommand($name, $arguments = [])
    {
        $this->application = new Application($this->getKernel());

        $command = $this->application->find($name);
        $tester = new CommandTester($command);
        $tester->execute($arguments);

        $this->getAssert()->setTester($tester);
    }

    /**
     * Get the assert.
     *
     * @return CommandAssert
     */
    abstract public function getAssert();
}
