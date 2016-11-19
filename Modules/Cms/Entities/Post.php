<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;
use StorAvell\User;

class Post extends Model
{
    protected $guarded = ['id'];
    protected $table = 'cms_posts';

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'cms_category_post', 'category_id', 'post_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
