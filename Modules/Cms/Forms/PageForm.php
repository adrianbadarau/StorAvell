<?php
/**
 * Created by PhpStorm.
 * User: adrianbadarau
 * Date: 11/20/16
 * Time: 7:46 AM
 */

namespace Modules\Cms\Forms;


use Kris\LaravelFormBuilder\Form;

class PageForm extends Form
{
    public function buildForm()
    {
        $this->add('title', 'text',[
            'rules' => 'required|min:15',
        ]);
        $this->add('slug', 'text',[
            'label' => 'Seo URL Slug',
            'rules' => 'required|unique:cms_pages',
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