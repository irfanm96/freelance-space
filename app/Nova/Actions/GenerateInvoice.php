<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use OwenMelbz\RadioField\RadioButton;
use Illuminate\Queue\InteractsWithQueue;

class GenerateInvoice extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $project_id = request('viaResourceId');
        if (!$project_id) {
            return Action::danger('Tasks should belongs to a single project!');
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Image::make('Template1')->preview(function ($value, $disk) {
                return 'https://via.placeholder.com/150?text="template1"';
            })->readonly(),
            Image::make('Template2')->preview(function ($value, $disk) {
                return 'https://via.placeholder.com/150?text="template2"';
            })->readonly(),
            Image::make('Template3')->preview(function ($value, $disk) {
                return 'https://via.placeholder.com/150?text="template3"';
            })->readonly(),
            RadioButton::make('Chose Template')
            ->options([
                0 => 'Template 1',
                1 => 'Template 2',
                2 => 'Template 3',
            ])
            ->default(0) // optional
            // ->stack() // optional (required to show hints)
            ->marginBetween() // optional
            ->skipTransformation() // optional
            ->toggle([  // optional
                0 => ['template2', 'template3'], // will hide max_skips and skip_sponsored when the value is 1
                1 => ['template1', 'template3'],
                2 => ['template1', 'template2'],
            ])
        ];
    }
}
