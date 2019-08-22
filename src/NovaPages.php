<?php

namespace Yassir3wad\NovaPages;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Yassir3wad\NovaPages\Resources\Page;

class NovaPages extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */

    public $resource = Page::class;

    private static $templates = [];

    public function boot()
    {
        Nova::script('nova-pages', __DIR__ . '/../dist/js/tool.js');
        Nova::style('nova-pages', __DIR__ . '/../dist/css/tool.css');

        Nova::resources([
            $this->resource
        ]);
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('nova-pages::navigation');
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }


    public static function setTemplates($templates): void
    {
        self::$templates = $templates;
    }

    public static function getTemplates(): array
    {
        return array_filter(self::$templates, function ($template) {
            return class_exists($template);
        });
    }
}
