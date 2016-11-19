<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = ['id'];
    protected $table = 'cms_pages';
}
