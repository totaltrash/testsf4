<?php

namespace App\Tests\Config;

/**
 * Local application test configuration to be used by all test cases
 */
trait Configuration
{
    // Define traits common to all test cases
    use FixtureFactory;

    // Define sequences for database resets
    private $sequences = array(
        'project_id_seq',
    );

    //define tables that should not be purged
    private $exclusions = [
        // 'dictionary',
    ];
}
