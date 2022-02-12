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

    /**
     * タスク追加-DBに値を入れる処理
     */
    public function store(Request $request)
    {
        // tasksテーブルにフォームで入力した値を挿入する
        $result = Task::create([
            'name' => $request->name,
            'content' => $request->content,
        ]);

        // タスク一覧画面にリダイレクト
        return redirect()->route('tasks.index');
    }
}
