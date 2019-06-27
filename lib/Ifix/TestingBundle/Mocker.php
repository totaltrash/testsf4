<?php

namespace Ifix\TestingBundle;

use Prophecy\Prophet;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Interacts with the Container to override services. Also provides some
 * helpers around creating prophecy mocks
 */
class Mocker
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Prophet
     */
    private $prophet;

    /**
     * Constructor.
     *
     * @param   ContainerInterface  $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->prophet = new Prophet();
    }

    /**
     * Reset the mocker
     *
     * Clears the prophet of promises, and resets the mock container
     */
    public function reset()
    {
        $this->prophet = new Prophet();
    }

    /**
     * Mock a service.
     *
     * @param   string  $serviceId  Could be the class name, or an old_style.service_id.
     *                              If an old style service id, the classname must be provided.
     * @param   string  $className
     *
     * @return Mock object
     */
    public function mockService($serviceId, $className = null)
    {
        if ($className === null) {
            $className = $serviceId;
        }

        // Prepend service id with 'test.', as all overridable services
        // need to be defined in test config and set to public
        $serviceId = 'test.' . $serviceId;
        $mock = $this->createMock($className);
        $this->container->set($serviceId, $mock->reveal());

        return $mock;
    }

    /**
     * Create a prophecy mock helper.
     *
     * @param string $className
     *
     * @return Mock object
     */
    public function createMock($className)
    {
        return $this->prophet->prophesize($className);
    }

    /**
     * Check the predictions for the mocks.
     */
    public function checkPredictions()
    {
        $this->prophet->checkPredictions();
    }
}
