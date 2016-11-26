<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    protected $table = 'cms_categories';

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'cms_category_post','post_id','category_id');
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'cms_category_page', 'page_id', 'category_id');
    }
}
