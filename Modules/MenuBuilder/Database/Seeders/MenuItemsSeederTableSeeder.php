<?php

namespace Modules\MenuBuilder\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\MenuBuilder\Entities\MenuItem;

class MenuItemsSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        MenuItem::create([
            'label' => 'Dashboard',
            'link' => 'admin/dashboard',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => null,
            'active_zone' => 'admin/dashboard',
            'icon_class' => 'dashboard'
        ]);
        MenuItem::create([
            'label' => 'Products',
            'link' => 'admin/products',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => null,
            'active_zone' => 'admin/products/*',
            'icon_class' => 'files-o'
        ]);
        MenuItem::create([
            'label' => 'Categories',
            'link' => 'admin/categories',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => null,
            'active_zone' => 'admin/categories/*',
            'icon_class' => 'th'
        ]);
        MenuItem::create([
            'label' => 'Menu Builder',
            'link' => 'admin/menubuilder',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => null,
            'active_zone' => 'admin/menubuilder/*',
            'icon_class' => 'bars'
        ]);
    }
}
