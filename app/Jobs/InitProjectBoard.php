<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InitProjectBoard implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $board_url;
    protected $project_id;
    protected $lists = [
        ['name' => 'Sprint BackLog', 'webhook_description' => 'Sprint backlog webhook', 'type' => 'sprint_backlog'],
        ['name' => 'In Progress', 'webhook_description' => 'In Progress webhook', 'type' => 'in_progress'],
        ['name' => 'In Staging', 'webhook_description' => 'In Staging webhook', 'type' => 'in_staging'],
        ['name' => 'In Production', 'webhook_description' => 'In Prodcution webhook', 'type' => 'in_prodcution'],
    ];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($project_id, $board_url)
    {
        $this->board_url = $board_url . '.json';
        $this->project_id = $project_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $api_token = env('TRELLO_API_TOKEN');
        $api_key = env('TRELLO_API_KEY');

        $response = Http::get("$this->board_url?key=$api_key&token=$api_token");

        if ($response->failed()) {
            ld('could not get borad id , request failed');
            return;
        }
        $response = $response->json();
        $boardID = $response['id'];
    }
    public function createList($name, $board_id)
    {
        $api_token = env('TRELLO_API_TOKEN');
        $api_key = env('TRELLO_API_KEY');
        $response = Http::post('https://api.trello.com/1/lists', [
            'name' => $name,
            'idBoard' => $board_id,
            'key' => $api_key,
            'token' => $api_token
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
                'callbackURL' => route("project.webhook.$type", $this->project_id)
            ]);
        return !$response->failed();
    }
}
