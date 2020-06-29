<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    private function processPayload($payload)
    {
        $task = [];
        $task['project_id'] = $payload['project_id'];
        $task['type'] = $payload['type'];
        $task['name'] = $payload['data']['card']['name'];
        $task['trello_card_id'] = $payload['data']['card']['id'];
        $task['action_type'] = $payload['type'];
        $task['display'] = $payload['display'];

        return $task;
    }

    public function handleInProdcutionList($project_id, Request $request)
    {
        $payload = $request->input('action');
        $payload['project_id'] = $project_id;
        $payload['type'] = 'in_production';
        $task = $this->processPayload($payload);
        $this->handleCardAction($task);
    }

    public function handleInStagingList($project_id, Request $request)
    {
        $payload = $request->input('action');
        $payload['project_id'] = $project_id;
        $payload['type'] = 'in_staging';
        $this->handleCardAction($payload);
    }

    public function handleInProgressList($project_id, Request $request)
    {
        $payload = $request->input('action');
        $payload['project_id'] = $project_id;
        $payload['type'] = 'in_progress';
        $this->handleCardAction($payload);
    }

    public function handleSprintBacklogList($project_id, Request $request)
    {
        $payload = $request->input('action');
        $payload['project_id'] = $project_id;
        $payload['type'] = 'sprint_backlog';
        $this->handleCardAction($payload);
    }

    private function handleCreateCard($data)
    {
        unset($data['display']);
    }

    private function handleUpdateCard($data)
    {
    }

    protected function handleCardAction($task)
    {
        $action_type = $task['action_type'];
        switch ($action_type) {
            case 'createCard':
                $this->handleCreateCard($task);
                break;
            case 'updateCard':
                $this->handleUpdateCard($task);
                break;
            default:
                break;
        }
    }
}
