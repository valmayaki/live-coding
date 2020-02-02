<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Fetches All task for a user for the day
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTodos(Request $request)
    {
        $todoRepo = app(\App\Repositories\TodoRepository::class);
        $todos = $todoRepo->getTodosForUser($request->user());
        return response()->json($todos);
    }
}
