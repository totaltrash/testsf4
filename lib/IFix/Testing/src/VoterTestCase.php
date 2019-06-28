<?php

namespace Application\Tests;

use Advtafe\Bundle\NtlmAuthBundle\Security\Authentication\Token\NtlmUserToken;

/**
 * @todo Fix this - copied from old project
 * Local application test helpers for testing voters
 */
abstract class VoterTestCase extends DomainTestCase
{
    /**
     * Authorization checker
     *
     * @var Symfony\Component\Security\Core\Authorization\AuthorizationChecker
     */
    protected $checker;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->checker = $this->getContainer()->get('security.authorization_checker');
    }

    /**
     * Add a token to the token storage
     *
     * @param   string      $username
     */
    protected function asUser($username)
    {
        $user = $this->entityManager->getRepository('AdvtafeUserBundle:User')->findOneByUsername($username);
        $token = new NtlmUserToken();
        $token->setUser($user);
        $this->getContainer()->get('security.token_storage')->setToken($token);
    }

    /**
     * Iterate the collection of roles, users, and subjects and check they are refuesed, unless
     * found in expectedGrantes
     */
    protected function checkAll(array $roles, array $users, array $subjects, array $expectedGrants)
    {
        foreach ($roles as $role) {
            foreach ($users as $user) {
                $this->asUser($user);
                foreach ($subjects as $subjectKey => $subject) {
                    $this->assertEquals(
                        $this->isAccessGrantedCase($role, $user, $subject, $expectedGrants),
                        $this->checker->isGranted($role, $subject),
                        sprintf('Voter failed for %s, %s, %s', $role, $user, $subjectKey)
                    );
                }
            }
        }
    }

    protected function isAccessGrantedCase($role, $user, $subject, array $expectedGrants)
    {
        return count(array_filter($expectedGrants, function ($case) use ($role, $user, $subject) {
            return
                $case[0] === $role &&
                $case[1] === $user &&
                $case[2] === $subject
            ;
        })) > 0;
    }
}
