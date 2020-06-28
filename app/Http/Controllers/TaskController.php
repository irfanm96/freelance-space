<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function handleInProdcutionList($project_id, Request $request)
    {
        $payload = $request->input('action');
        $payload['project_id'] = $project_id;
        $this->handleCardAction('in_production', $payload);
    }

    public function handleInStagingList($project_id, Request $request)
    {
        $payload = $request->input('action');
        $payload['project_id'] = $project_id;
        $this->handleCardAction('in_staging', $payload);
    }

    public function handleInProgressList($project_id, Request $request)
    {
        $payload = $request->input('action');
        $payload['project_id'] = $project_id;
        $this->handleCardAction('in_progress', $payload);
    }

    public function handleSprintBacklogList($project_id, Request $request)
    {
         $payload = $request->input('action');
        $payload['project_id'] = $project_id;
        $this->handleCardAction('sprint_backlog', $payload);
    }

    private function handleCreateCard($list, $data)
    {
    }

    private function handleUpdateCard($list, $data)
    {
    }

    protected function handleCardAction($list, $payload)
    {
        $type = $payload[''];
        switch ($type) {
            case 'createCard':
                $this->handleCreateCard($list, $payload);
                break;
            case 'updateCard':
                $this->handleUpdateCard($list, $payload);
                break;
            default:
                break;
        }
    }
}
