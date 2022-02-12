<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    /**
     * 一覧画面
     */
    public function index()
    {
        $tasks = Task::get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * 詳細画面
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * タスク追加
     */
    public function add()
    {
        return view('tasks.add');
    }
}
