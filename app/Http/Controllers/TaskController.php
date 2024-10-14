<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request)
    {

        if (auth()->check()) {

            $userId = auth()->user()->id;

            $data = $request->validate([
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'enddate' => ['required', 'date']
            ]);

            $task = Task::create([
                "title" => $data['title'],
                "description" => $data['description'],
                "end_date" => $data['enddate'],
                "user_id" => $userId,
                "step_id" => "dt_open",
                "status" => "open",
            ]);

            if ($task) {
                return response(["message" => "Задача добавлена"], 200);
            }
        } else {
            return response(["message" => "Пользователь не авторизован"], 422);
        }
    }
    public function delete(Request $request, string $position)
    {
        if (auth()->check()) {

            try {
                $tasks = session()->get('tasks');
                $id = $tasks[$position];
    
                $userId = auth()->user()->id;
    
                $task = new Task;
                $res = $task->where('id', '=', $id)
                    ->where('user_id', '=', $userId)
                    ->delete();
    
                if ($res) {
                    return response(["message" => "Задача успешно удалена"], 200);
                } else {
                    return response(["message" => "Произошла непредвиденная ошибка"], 402);
                }
            } catch (\ErrorException $e) {
                return response(["message" => "Произошла непредвиденная ошибка"], 500);
            }
            
        } else {
            return response(["message" => "Пользователь не авторизован"], 422);
        }
    }

    public function success(Request $request, string $position)
    {
        if (auth()->check()) {

            try {
                $tasks = session()->get('tasks');
                $id = $tasks[$position];
    
                $userId = auth()->user()->id;
    
                $task = new Task;
                $res = $task->where('id', '=', $id)
                    ->where('user_id', '=', $userId)
                    ->update(['status' => 'success', "step_id" => "dt_success"]);
    
                if ($res) {
                    return response(["message" => "Задача завершена!"], 200);
                } else {
                    return response(["message" => "Произошла непредвиденная ошибка"], 500);
                }
            } catch (\ErrorException $e) {
                return response(["message" => $e->getMessage()], 500);
            }
            
        } else {
            return response(["message" => "Пользователь не авторизован"], 422);
        }
    }
}
