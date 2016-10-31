<?php

namespace Modules\Product\Forms;

use Kris\LaravelFormBuilder\Form;

class ProductForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('is_active', 'select', [
                'choices' => [
                    0 => 'No',
                    1 => 'Yes'
                ],
                'selected' => 1
            ])
            ->add('price','number', [
                'attr' => [
                    'step' => 'any',
                    'min' => 0
                ]
            ])
            ->add('attributes','attributeField')
            ->add('Save_Product','submit',[
                'attr'=>[
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }
}
