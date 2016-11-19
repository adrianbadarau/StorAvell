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

        MenuItem::create([
            'label' => 'CMS Section',
            'link' => 'admin/cms',
            'open_in_new_tab' => 0,
            'is_active' => 1,
            'parent_id' => null,
            'active_zone' => 'admin/cms',
            'icon_class' => 'folder-open-o'
        ]);
    }
}
