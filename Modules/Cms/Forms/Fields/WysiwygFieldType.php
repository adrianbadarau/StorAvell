<?php
/**
 * Created by PhpStorm.
 * User: adrianbadarau
 * Date: 11/20/16
 * Time: 9:11 AM
 */

namespace Modules\Cms\Forms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;

class WysiwygFieldType extends FormField
{

    /**
     * Get the template, can be config variable or view path
     *
     * @return string
     */
    protected function getTemplate() :string
    {
        return "cms::forms.customFields.wysiwyg";
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        return parent::render($options, $showLabel, $showField, $showError);
    }
}