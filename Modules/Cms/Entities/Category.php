<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    protected $table = 'cms_categories';
}
