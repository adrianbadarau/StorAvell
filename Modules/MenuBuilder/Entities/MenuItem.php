<?php

namespace Modules\MenuBuilder\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $guarded = ['id'];

    public function children()
    {
        return $this->hasMany('Modules\MenuBuilder\Entities\MenuItem','parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo('Modules\MenuBuilder\Entities\MenuItem','parent_id','id');
    }
}
