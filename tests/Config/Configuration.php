<?php

namespace Tests\Config;

/**
 * Local application test configuration to be used by all test cases
 */
trait Configuration
{
    // Define traits common to all test cases
    use FixtureFactory;

    // Define sequences for database resets
    private $sequences = array(
        'app_user_id_seq',
        'project_id_seq',
        'task_id_seq',
        'project_type_id_seq',
        'project_title_id_seq',
        'task_title_id_seq',
        'organisation_id_seq',
        'contact_id_seq',
        'contact_email_id_seq',
        'contact_phone_id_seq',
        'contact_address_id_seq',
    );

    //define tables that should not be purged
    private $exclusions = [
        // 'dictionary',
    ];
}
