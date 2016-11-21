<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = ['id'];
    protected $table = 'cms_pages';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->author_id = \Auth::getUser()->id;
        });
    }
}
