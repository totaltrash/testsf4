<?php

namespace IFix\Testing\Command;

use IFix\Testing\Assert as BaseAssert;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Generic assertions for use in a command context.
 */
abstract class Assert extends BaseAssert
{
    /**
     * Get Tester.
     *
     * @return CommandTester
     */
    abstract public function getTester();

    /**
     * Set Tester.
     *
     * @param CommandTester $tester
     */
    abstract public function setTester(CommandTester $tester);

    /**
     * Check the exit code is as expected.
     *
     * @param string|int $expected
     */
    public function exitCodeEquals($expected)
    {
        $this->assert(
            $this->getTester()->getStatusCode() === (int) $expected,
            sprintf(
                'Incorrect exit code - expected %d, got %d',
                $expected,
                $this->getTester()->getStatusCode()
            )
        );
    }

    /**
     * Check that the expected string is displayed in the console.
     *
     * @param string $expected
     */
    public function seeInConsole($expected)
    {
        $this->assert(
            strpos($this->getTester()->getDisplay(), $expected) !== false,
            sprintf(
                'Unexpected console message, expected "%s", got "%s"',
                $expected,
                $this->getTester()->getDisplay()
            )
        );
    }
}
