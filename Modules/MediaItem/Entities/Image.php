<?php

namespace Modules\MediaItem\Entities;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = ['id'];
    protected $table = 'media_item_images';
    
    public function parentItem(string $related)
    {
        return $this->morphedByMany($related, 'mediable', 'media_item_mediable','id');
    }
}
