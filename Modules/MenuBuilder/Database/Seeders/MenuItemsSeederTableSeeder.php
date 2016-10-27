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
            'link' => '/admin/dashboard',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => null,
            'active_zone' => '/admin/dashboard'
        ]);
        MenuItem::create([
            'label' => 'Products',
            'link' => '/products',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => null,
            'active_zone' => '/products/*'
        ]);
        MenuItem::create([
            'label' => 'Categories',
            'link' => '/categories',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => null,
            'active_zone' => '/categories/*'
        ]);
        MenuItem::create([
            'label' => 'Test Case',
            'link' => '/test',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => null,
            'active_zone' => '/test/*'
        ]);
        MenuItem::create([
            'label' => 'SubTest',
            'link' => '/test/sub',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => 4,
            'active_zone' => '/test/sub'
        ]);
        MenuItem::create([
            'label' => 'SubTest2',
            'link' => '/test/sub2',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => 4,
            'active_zone' => '/test/sub2'
        ]);
        MenuItem::create([
            'label' => 'SubTest3',
            'link' => '/test/sub/sub',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => 6,
            'active_zone' => '/test/sub2/sub'
        ]);
    }
}
