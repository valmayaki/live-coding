<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function index(Request $request){
        $todoRepo = app(\App\Repositories\TodoRepository::class);
        $todos = $todoRepo->getTodosForUser($request->user());
        return response()->json($todos);
    }
}
