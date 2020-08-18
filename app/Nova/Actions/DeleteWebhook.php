<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class DeleteWebhook extends Action
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
        foreach ($models as $webhook) {
            $api_token = env('TRELLO_API_TOKEN');
            $api_key = env('TRELLO_API_KEY');
            $response = Http::delete("https://api.trello.com/1/webhooks/$webhook->webhook_id", [
                'key' => $api_key,
                'token' => $api_token,
            ]);
            if ($response->failed()) {
                ld('webhook delete failed');
                ld($response->body());
            }
            $webhook->delete();
            ld('webhook deleted sucessfully');
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
