<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Step;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Step::create([
            "title" => "В работе",
            "description" => "Задача находится в процессе выполнения",
            "id_all" => "dt_open",
            "position" => 1
        ]);

        Step::create([
            "title" => "На проверке",
            "description" => "Задача находится на проверке",
            "id_all" => "dt_check",
            "position" => 2
        ]);

        Step::create([
            "title" => "Выполнено",
            "description" => "Задача успешно выполнена",
            "id_all" => "dt_success",
            "position" => 3
        ]);

        Step::create([
            "title" => "Провалено",
            "description" => "Задача не выполнена",
            "id_all" => "dt_failed",
            "position" => 3
        ]);
    }
}
