<?php

namespace App\Jobs;

use App\Project;
use App\Webhook;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class InitProjectBoard implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $board_url;
    protected Project $project;
    protected $lists = [
        ['name' => 'In Production', 'webhook_description' => 'In Prodcution webhook', 'type' => 'in_production'],
        ['name' => 'In Staging', 'webhook_description' => 'In Staging webhook', 'type' => 'in_staging'],
        ['name' => 'In Progress', 'webhook_description' => 'In Progress webhook', 'type' => 'in_progress'],
        ['name' => 'Sprint BackLog', 'webhook_description' => 'Sprint backlog webhook', 'type' => 'sprint_backlog'],
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->board_url = $project->board_url . '.json';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ld('job started');
        $api_token = env('TRELLO_API_TOKEN');
        $api_key = env('TRELLO_API_KEY');

        $response = Http::get("$this->board_url?key=$api_key&token=$api_token");

        if ($response->failed()) {
            ld($response->body());
            ld('could not get borad id , request failed');

            return;
        }
        $response = $response->json();
        $boardID = $response['id'];
        $this->project->update(['board_id' => $boardID]);

        foreach ($this->lists as $list) {
            $list_id = $this->createList($list['name'], $boardID);
            if ($list_id != null) {
                ld('created a list');
                $webhook_id = $this->createWebHook($list_id, $list['webhook_description'], $list['type']);
                if ($webhook_id != null) {
                    Webhook::create([
                        'project_id' => $this->project->id,
                        'list_id' => $list_id,
                        'webhook_id' => $webhook_id,
                        'webhook_type' => $list['type'],
                    ]);
                }
            }
        }
    }

    public function createList($name, $board_id)
    {
        $api_token = env('TRELLO_API_TOKEN');
        $api_key = env('TRELLO_API_KEY');
        $response = Http::post('https://api.trello.com/1/lists', [
            'name' => $name,
            'idBoard' => $board_id,
            'key' => $api_key,
            'token' => $api_token,
        ]);
        if ($response->failed()) {
            return null;
        }
        $response = $response->json();

        return $response['id'];
    }

    public function createWebHook($list_id, $description, $type)
    {
        $api_token = env('TRELLO_API_TOKEN');
        $api_key = env('TRELLO_API_KEY');
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post('https://api.trello.com/1/webhooks/', [
            'idModel' => $list_id,
            'key' => $api_key,
            'description' => $description,
            'token' => $api_token,
            // 'callbackURL' => route("project.webhook.$type", $this->project->id)
            'callbackURL' => route("project.webhook.$type", $this->project->id),
        ]);
        if ($response->failed()) {
            ld($response->body());
            ld('webhook creation failed');

            return null;
        }
        $response = $response->json();
        ld('webhook created sucessfully');
        ld($response);

        return $response['id'];
    }
}
