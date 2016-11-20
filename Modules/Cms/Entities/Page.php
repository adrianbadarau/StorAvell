<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = ['id'];
    protected $table = 'cms_pages';

//    public function setAuthorIdAttribute($value)
//    {
//        $this->attributes['author_id'] = \Auth::getUser()->id;
//    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->author_id = \Auth::getUser()->id;
        });
    }
}
