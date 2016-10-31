<?php
/**
 * Created by PhpStorm.
 * User: adrianbadarau
 * Date: 31/10/2016
 * Time: 21:08
 */

namespace Modules\Product\Forms;


use Kris\LaravelFormBuilder\Fields\FormField;

class AttributeFieldType extends FormField
{

    /**
     * Get the template, can be config variable or view path
     *
     * @return string
     */
    protected function getTemplate() : string
    {
        return 'product::forms.customFields.attributeField';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        return parent::render($options, $showLabel, $showField, $showError);
    }
}