<?php
/**
 * Created by PhpStorm.
 * User: adrianbadarau
 * Date: 26/11/2016
 * Time: 13:09
 */

namespace Modules\Cms\Forms;


use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form 
{
    public function buildForm()
    {
        $this->add('name','text');
    }
}