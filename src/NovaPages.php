<?php

namespace Yassir3wad\NovaPages;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaPages extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */

    public function boot()
    {
        Nova::script('nova-pages', __DIR__ . '/../dist/js/tool.js');
        Nova::style('nova-pages', __DIR__ . '/../dist/css/tool.css');

        Nova::resources([
            config('novapages.page_resource')
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

    public static function getTemplates(): array
    {
        return array_filter(config('novapages.templates', []), function ($template) {
            return class_exists($template);
        });
    }
}
