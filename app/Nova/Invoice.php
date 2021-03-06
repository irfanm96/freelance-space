<?php

namespace App\Nova;

use App\Nova\Filters\ProjectFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Metrixinfo\Nova\Fields\Iframe;

class Invoice extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Invoice::class;

    public static $group = 'Workspace';

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
            Date::make('Date')->sortable(),
            Number::make('Discount')->sortable(),
            Select::make('Template')->options([
                '1' => 'Template 1',
                '2' => 'Template 2',
                '3' => 'Template 3',
            ]),
            Select::make('Status')->options([
                'pending' => 'Pending',
                'cleared' => 'Cleared',
            ])->onlyOnForms(),
            Badge::make('status')->map([
                'pending' => 'warning',
                'cleared' => 'success',
            ])->exceptOnForms(),
            Iframe::make('Generated Invoice', function () {
                $invoice = Invoice::where('id', $this->id)->with('tasks', 'project')->first();

                return view("invoice-templates.template$invoice->template", ['invoice' => $invoice, 'iframe' => true])->render();
            }),
            BelongsTo::make('Project'),
            BelongsTo::make('User'),
            BelongsTo::make('BankDetail'),
            Trix::make('To'),
            BelongsToMany::make('Tasks'),
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
