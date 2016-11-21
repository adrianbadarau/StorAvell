<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;
use StorAvell\User;

class Page extends Model
{
    protected $guarded = ['id'];
    protected $table = 'cms_pages';

    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->author_id = \Auth::getUser()->id;
        });
    }
}
