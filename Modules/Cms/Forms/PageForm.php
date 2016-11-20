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
        $this->add('title', 'text');
        $this->add('slug','text');
        $this->add('content', 'wysiwyg');
        $this->add('is_active','select',[
            'choices' => [
                0 => 'No',
                1 => 'Yes'
            ],
            'selected' => 0
        ]);
    }
}