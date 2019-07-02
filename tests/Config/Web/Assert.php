<?php

namespace Tests\Config\Web;

use Behat\Mink\Session;
use IFix\Testing\Web\Assert as BaseAssert;

/**
 * Local application assertions for testing in a web context
 *
 * Store application specific assertions here. Alternatively,
 * set up a trait for each feature and use them here.
 */
class Assert extends BaseAssert
{
    /**
     * @param   Session    $session
     */
    public function __construct(Session $session)
    {
        parent::__construct($session);
    }
}
