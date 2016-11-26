<?php
/**
 * Created by PhpStorm.
 * User: adrianbadarau
 * Date: 26/11/2016
 * Time: 09:09
 */

namespace Modules\Cms\Forms;


use Kris\LaravelFormBuilder\Form;

class PostsForm extends Form 
{
    public function buildForm()
    {
        $this->add('title', 'text',[
            'rules' => 'required|min:5',
        ]);
        $this->add('slug', 'text',[
            'label' => 'Seo URL Slug',
            'rules' => 'unique:cms_posts',
            'error_messages' => [
                'slug.required' => 'The slug is a mandatory field',
                'slug.unique' => 'There url slug must me unique'
            ]
        ]);
        $this->add('content', 'wysiwyg',[
            'rules' => 'required'
        ]);
        $this->add('is_active', 'select', [
            'choices' => [
                0 => 'No',
                1 => 'Yes'
            ],
            'selected' => 0
        ]);
        $this->add('Submit', 'submit');
    }
}