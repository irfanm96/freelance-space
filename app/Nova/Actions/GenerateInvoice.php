<?php

namespace App\Nova\Actions;

use App\Invoice;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Heading;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use OwenMelbz\RadioField\RadioButton;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;

class GenerateInvoice extends Action
{
    use InteractsWithQueue, Queueable;
    protected $project;

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
        // $task_types = $models->pluck('type')->toArray();
        // $not_allowed_types = ['in_staging', 'in_progress', 'sprint_backlog'];
        // if (count(array_intersect($task_types, $not_allowed_types)) > 0) {
        //     return Action::danger('Selected Tasks should be in production to generate the invoice!');
        // }
        $data = [];
        $data['to'] = $fields->to;
        $data['date'] = $fields->date;
        $data['template'] = $fields->template;
        $data['bank_detail_id'] = $fields->from;
        $data['project_id'] = $this->project->id;
        $data['user_id'] = auth()->user()->id;
        $data['discount'] = $fields->discount;
        $invoice = Invoice::create($data);
        $invoice->tasks()->attach($models->pluck('id')->toArray());
        return Action::message('Invoice Generated');
    }

    public function __construct(Request $request)
    {
        $this->project = Project::find($request->input('viaResourceId'));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        $project = $this->project;
        $billing_to = $project->getBillingDetails();
        $bllling_from = auth()->user()->bankDetails->pluck('name', 'id')->toArray();
        return [
            Heading::make("<p> Invoice For Project:  $project->name </p><p class='text-sm'>Note: Selected Tasks should be in production to generate the invoice.</p>")->asHtml(),
            Trix::make('To')->withMeta(['value' => $billing_to]),
            Select::make('From')->options($bllling_from),
            Date::make('Date')->withMeta(['value' => now()]),
            Number::make('Discount')->withMeta(['value' => 0]),
            Image::make('Template1')->preview(function ($value, $disk) {
                return 'https://via.placeholder.com/150?text="TailwindCss"';
            })->readonly(),
            Image::make('Template2')->preview(function ($value, $disk) {
                return 'https://via.placeholder.com/150?text="ComingSoon.."';
            })->readonly(),
            Image::make('Template3')->preview(function ($value, $disk) {
                return 'https://via.placeholder.com/150?text="ComingSoon.."';
            })->readonly(),
            RadioButton::make('Template')
            ->options([
                1 => 'Template 1',
                2 => 'Template 2',
                3 => 'Template 3',
            ])
            ->default(1) // optional
            ->marginBetween() // optional
            ->skipTransformation() // optional
            ->toggle([  // optional
                1 => ['template2', 'template3'], // will hide max_skips and skip_sponsored when the value is 1
                2 => ['template1', 'template3'],
                3 => ['template1', 'template2'],
            ])
        ];
    }
}
