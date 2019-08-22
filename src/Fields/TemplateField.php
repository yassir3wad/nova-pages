<?php

namespace Yassir3wad\NovaPages\Fields;

use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Select;
use Yassir3wad\NovaPages\NovaPages;

class TemplateField extends Select
{
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $templates = array_map(function ($template) {
            return [
                'label' => $template::$name,
                'value' => $template::$name
            ];
        }, NovaPages::getTemplates());

        $this->options($templates);

        $templates = array_map(function ($template) {
            return $template::$name;
        }, $templates);

        $this->rules(Rule::in(Arr::only($templates, "value")));
    }
}
