<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use App\Models\Step;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Contracts\View\Factory as ViewFactory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    if (auth()->check()) {
        $userId = auth()->user()['id'];
        $backlog = Task::orWhere(['created_by'=> $userId, 'assigned_by' => $userId])->get();
        $countTasks = count($backlog);

        ###
        $tasks = [];
        foreach ($backlog as $task) {
            $tasks[] = $task['id'];
        }

        session(['tasks' => $tasks]); // заполнение списка идентификаторов задач
        ###

        return view('main', ["countTasks" =>  $countTasks, "backlog" => $backlog]);
    }

    return view('main');
})->name('main');

Route::get('/tasks/sort/{sort}', function (string $sort) {

    if (auth()->check()) {

        $userId = auth()->user()['id'];

        if ($sort == "all") {
            $list = Task::orWhere(['created_by'=> $userId, 'assigned_by' => $userId])->get();
        } else {
            $list = Task::orWhere(['created_by'=> $userId, 'assigned_by' => $userId])->where('status', $sort)->get();
        }

        ###
        $tasks = [];
        foreach ($list as $task) {
            $tasks[] = $task['id'];
        }

        session(['tasks' => $tasks]); // заполнение списка идентификаторов задач
        ###

        $count = count($list);

        return response(["list" => $list, "count" => $count], 200);
    }

    return response(["message" => "Пользователь не авторизован"], 422);
})->name('sort');

Route::get("/task/{id}", function (string $id) {

    if (auth()->check()) {

        $userId = auth()->user()->id;
        $steps = Step::get();

        $isActive = false;

        $task = Task::where('id', (int)$id)->first();

        // Предусмотреть переход на задачу, которая была удалена (возможно не удалять задачи, а помечать удаленными)

        if($userId != $task->created_by && $userId != $task->assigned_by) {
            $isAccess = true;
            // return redirect("/");
        } else {
            $isAccess = true;
        }

        // $currentStep = $task->step_id;

        // $stepsArr = [];
        // foreach($steps as $step) {
        //     if($currentStep == $step->id_all) {
        //         $stepsArr[$step->id_all] = ['title' => $step->title, "active" => true];
        //     } else {
        //         $stepsArr[$step->id_all] = ['title' => $step->title, "active" => false];
        //     }
        // }

        return view('task', ["task" => $task, "steps" => $steps, 'isActive' => $isActive, 'currentUserId' => $userId, 'isAccess' => $isAccess]);
    } else {
        return redirect('/');
    }
})->name("task.view");

Route::controller(TaskController::class)->group(function () {
    Route::post('/task/create', "create")->name('task.create');

    Route::patch('/task/success/{position}', "success")->name('task.success');

    Route::delete('/task/{position}', "delete")->name('task.delete');
});


Route::controller(AuthController::class)->group(function () {
    Route::get("/logout", 'logout')->name("logout");

    Route::post("/login", 'login')->name("login");

    Route::post("/register", 'register')->name("register");
});
