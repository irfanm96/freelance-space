<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use App\Nova\Filters\TaskType;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Filters\ProjectFilter;
use App\Nova\Lenses\CompletedTasks;
use App\Nova\Actions\GenerateInvoice;
use Laravel\Nova\Http\Requests\NovaRequest;

class Task extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Task::class;
    public static $group = 'Workspace';

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
        'id', 'name'
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
            Text::make('Name'),
            Text::make('Trello card', 'trello_card_id'),
            Badge::make('Type')->map([
                'sprint_backlog' => 'danger',
                'in_progress' => 'info',
                'in_staging' => 'warning',
                'in_production' => 'success'
            ]),
            Select::make('Type')->options([
                'sprint_backlog' => 'danger',
                'in_progress' => 'info',
                'in_staging' => 'warning',
                'in_production' => 'success'
            ])->onlyOnForms(),
            Number::make('Hours')->sortable(),
            BelongsTo::make('Project')
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
        return [
            new ProjectFilter,
            new TaskType
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [new CompletedTasks];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [(new GenerateInvoice($request))->canSee(function () use ($request) {
            return ($request->viaResource === 'projects');
        })];
    }

    public function serializeForIndex(NovaRequest $request, $fields = null)
    {
        // Get proper response
        $serialized = parent::serializeForIndex($request, $fields);

        if ($request->lens && $request->lens == 'completed-tasks') {
            // If a lens is being viewed
            $serialized = array_merge($serialized, [
                'authorizedToView' => false,
                'authorizedToUpdate' => false,
                'authorizedToDelete' => false,
                'authorizedToRestore' => false,
                'authorizedToForceDelete' => false,
            ]);
        }

        return $serialized;
    }
}
