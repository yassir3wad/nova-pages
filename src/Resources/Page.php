<?php

namespace Yassir3wad\NovaPages\Resources;

use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

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

            Text::make("Name")->sortable(),

            Text::make("Template")->sortable(),

            Indicator::make('Status')
                ->labels([
                    \Yassir3wad\NovaPages\Models\Page::STATUS_PUBLISHED => 'PUBLISHED',
                    \Yassir3wad\NovaPages\Models\Page::STATUS_DRAFT => 'DRAFT'
                ])->colors([
                    \Yassir3wad\NovaPages\Models\Page::STATUS_PUBLISHED => 'green',
                    \Yassir3wad\NovaPages\Models\Page::STATUS_DRAFT => 'grey'
                ]),

            DateTime::make("Last Update", "updated_at")->sortable(),
        ];
    }
}
