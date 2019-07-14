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
        
        if ($sc->isGranted('ROLE_ADMIN')) {
            $admin = $menu->addChild('Admin', ['attributes' => ['dropdown' => true]]);
            $admin->addChild('User Management', ['route' => 'admin_user_index']);
            $admin->addChild('Project Types', ['route' => 'admin_project_type_index']);
            $admin->addChild('Project Titles', ['route' => 'admin_project_title_index']);
            $admin->addChild('Task Titles', ['route' => 'admin_task_title_index']);
        }

        $profile = $menu->addChild('Profile', ['attributes' => ['dropdown' => true]]);
        $profile->addChild('My Profile', ['route' => 'profile_index']);
        $profile->addChild('Change Password', ['route' => 'profile_change_password']);
        $profile->addChild('Logout', ['route' => 'security_logout']);

        $example = $menu->addChild('Example', ['attributes' => ['dropdown' => true]]);
        $example->addChild('Table', ['route' => 'test_table']);
        $example->addChild('Service', ['route' => 'test_service']);
        $example->addChild('Other', ['route' => 'test_other']);

        return $menu;
    }
}
