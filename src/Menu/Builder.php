<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;

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

    public function createMainMenu()
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(['class' => 'navbar-nav']);

        $menu->addChild('Projects', ['route' => 'project_index']);
        $menu->addChild('Table', ['route' => 'test_table']);
        $menu->addChild('Other', ['route' => 'test_other']);

        $admin = $menu->addChild('Admin', ['attributes' => ['dropdown' => true]]);
        $admin->addChild('Table', ['route' => 'test_table']);
        $admin->addChild('Other', ['route' => 'test_other']);

        return $menu;
    }
}