<?php

namespace App\Http\Controllers;

use App\Task;
use App\Webhook;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    private function processPayload($project_id, $type, $payload)
    {
        $task = [];
        $task['project_id'] = $project_id;
        $task['type'] = $type;
        $task['name'] = $payload['data']['card']['name'];
        $task['trello_card_id'] = $payload['data']['card']['id'];
        $task['action_type'] = $payload['type'];
        $task['display'] = $payload['display'];

        return $task;
    }

    public function handleInProdcutionList($project_id, Request $request)
    {
        $task = $this->processPayload($project_id, 'in_production', $request->input('action'));
        $this->handleCardAction($task);
        return response('ok')->setStatusCode(200);
    }

    public function handleInStagingList($project_id, Request $request)
    {
        $task = $this->processPayload($project_id, 'in_staging', $request->input('action'));
        $this->handleCardAction($task);
        return response('ok')->setStatusCode(200);
    }

    public function handleInProgressList($project_id, Request $request)
    {
        $task = $this->processPayload($project_id, 'in_progress', $request->input('action'));
        $this->handleCardAction($task);
        return response('ok')->setStatusCode(200);
    }

    public function handleSprintBacklogList($project_id, Request $request)
    {
        $task = $this->handleCardAction($project_id, 'sprint_backlog', $request->input('action'));
        $this->handleCardAction($task);
        return response('ok')->setStatusCode(200);
    }

    private function handleCreateCard($data)
    {
        unset($data['display']);
        Task::create($data);
        ld('task created successfully');
    }

    private function handleUpdateCard($data)
    {
        $display = $data['display'];
        if ($display['action_move_card_from_list_to_list']) {
            $list_after = $display['entities']['listAfter'];
            $webhook = Webhook::where('list_id', $list_after)->first();
            $data['type'] = $webhook->webhook_type;
        }
        $task = Task::where('trello_card_id', $data['trello_card_id'])->first();
        $task->update($data);
    }

    protected function handleCardAction($task)
    {
        $action_type = $task['action_type'];
        unset($task['action_type']);
        ld('handle card action', $action_type);
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
