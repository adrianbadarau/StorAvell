<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function getCustomAttributes($values)
    {
        return json_decode($values);
    }

    public function setCustomAttributes($values)
    {
        $this->attributes['custom_attributes'] = json_encode($values);
    }

    public function mediaItems(string $related)
    {
        return $this->morphToMany($related, 'mediable', 'media_item_mediable', null, 'media_id');
    }
}
