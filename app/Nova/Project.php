<?php

namespace App\Nova;

use App\Nova\Actions\EnableTrello;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use OptimistDigital\MultiselectField\Multiselect;

class Project extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Project::class;

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
        'id',
    ];

    public function subtitle()
    {
        return "rate in USD/Hour: {$this->rate}";
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make("Name"),
            Textarea::make('Description'),
            Multiselect
                ::make('Project Type', 'type')
                ->options([
                    'android' => 'Android',
                    'ios' => 'IOS',
                    'flutter' => 'Flutter',
                    'web' => 'Web'
                ])
                ->placeholder('Choose project type') // Placeholder text
                ->saveAsJSON(), // Saves value as JSON if the database column is of JSON type
            Number::make('Rate'),
            Text::make('Board Url', function () {
                return '<a target="_blank" href="' . $this->board_url . '">' . $this->board_url . '</a>';
            })->asHtml()->exceptOnForms(),
            Text::make('Board Url')->onlyOnForms(),
            BelongsTo::make('Team'),
            HasMany::make('Tasks'),
            HasMany::make('Invoices'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new EnableTrello
        ];
    }
}
