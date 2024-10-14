<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $return = ["error" => []];

        $data = $request->validate([
            "email" => ['required', 'email', 'string'],
            "password" => ['required', 'string'],
        ]);

        if(auth("web")->attempt($data)) {
            return response(["message" => "Успешная авторизация!"], 200);
        } 

        $return["error"]["message"] = "Ошибка авторизации. Проверьте правильность введенных данных!";

        return response($return, 422);
    }

    public function logout()
    {
        auth("web")->logout();
    }

    public function register(Request $request)
    {

        $return = ["error" => []];

        $data = $request->validate([
            "name" => ["required", "string"],
            "email" => ['required', 'email', 'string', "unique:users,email"],
            "password" => ['required', 'string'],
        ]);


        $user = User::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => bcrypt($data['password']),
        ]);

        if ($user) {
            auth("web")->login($user);
            return response(["message" => "Успешная регистрация!"], 200);
        }

        $return["error"]["message"] = "Ошибка регистрации. Проверьте правильность введенных данных!";
        return response($return, 422);
    }
}
