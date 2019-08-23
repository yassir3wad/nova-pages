<?php

namespace Yassir3wad\NovaPages\Resources;

use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\CreateResourceRequest;
use Laravel\Nova\Resource;
use Yassir3wad\NovaPages\Fields\TemplateField;
use Yassir3wad\NovaPages\NovaPages;

class Page extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Yassir3wad\NovaPages\Models\Page::class;

    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'template', 'updated_at', 'status'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make("Name")->rules('required')->sortable(),

            Text::make("Slug")
                ->rules("required")
                ->creationRules("unique:pages,slug")
                ->creationRules("unique:pages,slug,{{resourceId}}")
                ->sortable(),

            TemplateField::make("Template")->rules("required")->sortable(),

            DateTime::make("Last Update", "updated_at")->exceptOnForms()->sortable(),
        ];
    }

    protected function getTemplateClass($request)
    {
        if ($request instanceof CreateResourceRequest)
            return null;

        $this->template = $this->template || request('template');

        if (isset($this->template) && $this->template) {
            foreach (NovaPages::getTemplates() as $template) {
                if ($template::$name == $this->template)  return new $template();
            }

            throw new \Exception("template $this->template does not exists");
        }

        return null;
    }
}
