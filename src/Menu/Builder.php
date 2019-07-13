<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class Builder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(AuthorizationCheckerInterface $sc)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(['class' => 'navbar-nav']);

        $menu->addChild('Projects', ['route' => 'project_index']);
        $menu->addChild('Table', ['route' => 'test_table']);
        $menu->addChild('Service', ['route' => 'test_service']);
        $menu->addChild('Other', ['route' => 'test_other']);
        $menu->addChild('Profile', ['route' => 'profile_index']);
        $menu->addChild('Logout', ['route' => 'security_logout']);

        if ($sc->isGranted('ROLE_ADMIN')) {
            $admin = $menu->addChild('Admin', ['attributes' => ['dropdown' => true]]);
            $admin->addChild('User Management', ['route' => 'admin_user_index']);
            $admin->addChild('Project Types', ['route' => 'admin_project_type_index']);
            $admin->addChild('Project Titles', ['route' => 'admin_project_title_index']);
        }

        return $menu;
    }
}
