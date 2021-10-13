<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function index() {
        $Todos = Todo::all();
        return response()->json($Todos);
    }

    public function store(Request $request) {
        $todoData = $request->get('todo');

        $Todo = new Todo();
        $Todo->fill($todoData);
        $Todo->save();

        return response()->json($Todo);
    }
}
