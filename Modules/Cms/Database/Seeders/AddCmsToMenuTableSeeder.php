<?php

namespace Modules\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\MenuBuilder\Entities\MenuItem;

class AddCmsToMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $parent = MenuItem::create([
            'label' => 'CMS Section',
            'link' => 'admin/cms/page',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => null,
            'active_zone' => '',
            'icon_class' => 'folder-open-o'
        ]);

        MenuItem::create([
            'label' => 'Pages',
            'link' => 'admin/cms/page',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => $parent->id,
            'active_zone' => 'admin/cms/page',
            'icon_class' => 'file-text-o'
        ]);
        MenuItem::create([
            'label' => 'Posts',
            'link' => 'admin/cms/post',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => $parent->id,
            'active_zone' => 'admin/cms/post/*',
            'icon_class' => 'newspaper-o'
        ]);
        MenuItem::create([
            'label' => 'CMS Categories',
            'link' => 'admin/cms/category',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => $parent->id,
            'active_zone' => 'admin/cms/category/*',
            'icon_class' => 'sitemap'
        ]);
    }
}
