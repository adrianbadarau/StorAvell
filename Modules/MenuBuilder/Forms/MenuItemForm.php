<?php

namespace Modules\MenuBuilder\Forms;

use Kris\LaravelFormBuilder\Form;
use Modules\MenuBuilder\Entities\MenuItem;

class MenuItemForm extends Form
{
    protected  $formOptions;

    public function __construct()
    {
        $this->formOptions = [
            'method' => 'POST',
            'url' => route('menubuilder.store')
        ];
    }

    public function buildForm()
    {
        $this
            ->add('label', 'text')
            ->add('link', 'text')
            ->add('open_in_new_tab', 'select', [
                'choices' => [
                    0 => 'No',
                    1 => 'Yes'
                ],
                'selected' => 0
            ])
            ->add('is_active', 'select', [
                'choices' => [
                    0 => 'No',
                    1 => 'Yes'
                ],
                'selected' => 1
            ])
            ->add('parent_id', 'entity', [
                'class' => MenuItem::class,
                'property' => 'label',
                'property_key' => 'id',
                'label' => 'Parent menu item',
                'empty_value' => '=== Main Item ==='
            ])
            ->add('active_zone', 'text')
            ->add('icon_class','text')
            ->add('Save_Menu_Item','submit',[
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }
}
