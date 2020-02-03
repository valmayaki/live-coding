<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * A taskService instance
     *
     * @var \App\Services\TaskService
     */
    protected $taskService;

    function __construct(\App\Services\TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    public function updateStatus(\App\Task $task, Request $request)
    {
        try{
            $updateTask = $this->taskService->updateStatus($task, $request['isDone']);
            return response()->json(['data' => $updateTask]);
        }catch(\InvalidArgumentException $ex){
            return response()->json([
                'message' => $ex->getMessage(),
            ], 422);
        }
    }

    public function createTask(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'string',
            'due_at' => 'required|date'
        ]);
        $data = $request->input();
        $task = $this->taskService->createTask($data);
        return response()->json([
            'data' => $task
        ], 201);
    }
    public function getTasks(Request $request)
    {
        $user = $request->user();
        $requestOptions = $request->all();
        $tasks = $this->taskService->getTaskForUser($user, $requestOptions);
        return response()->json($tasks);
    }

    public function updateTask(\App\Task $task, Request $request)
    {
        $data = $request->input();
        $updateTask = $this->taskService->updateTask($task, $data);
        return response()->json(['data' => $updateTask]);
    }

    public function destroy(\App\Task $task, Request $request)
    {
        # code...
    }
}
