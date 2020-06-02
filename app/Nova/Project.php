<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
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
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

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
            BelongsTo::make('Team'),
            HasMany::make('Tasks'),
            HasMany::make('Invoices'),
        ];
    }
//     curl --request POST \
//   --url 'https://api.trello.com/1/lists?name=testList&idBoard=5ed5cd14c1b0a32e7493e8ea&key=8730e5771851bda022e49431033d7dba&token=21f05a382396ccb4e41fe0e87f5f53ccbb48cd8a747d48eb1de079dfd9cf4b3d'


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
        return [];
    }
}
