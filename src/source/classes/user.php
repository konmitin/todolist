<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/source/db.php");

class User {
    protected $id = "";
    protected $name = "";
    protected $login = "";
    protected $password = "";

    public function __construct() {

    }

    public static function register($name, $login, $password) {
        global $DB;

        $out = array();
        $out['status'] = 0;
        $out['message'] = "Ошибка регистрации. Что-то пошло не так!";

        $checkLogin_q = "SELECT * FROM `users` WHERE `users`.`login` = ?";

        $stmt = $DB->prepare($checkLogin_q);
        $stmt->bind_param("s", $login);
        $stmt->execute();
        
        if($stmt->fetch()) {
            $out['message'] = "Ошибка регистрации. Пользователь с таким логином уже зарегистрирован!";
            $out['status'] = 0;
            return $out;
        }

        $registerDate = date('Y-m-d H:i:s');
        $password = md5(md5($password));
        $registerLogin_q = "INSERT INTO `users` (name, login, password, register_date) VALUES (?,?,?,?)";
        $stmt = $DB->prepare($registerLogin_q);
        $stmt->bind_param("ssss", $name, $login, $password, $registerDate);
        $res = $stmt->execute();
        if($res) {
            $out['status'] = 1;
            $out['message'] = "Поздравляю! Вы успешно зарегистрированы!";
            $out['result'] = $res;
        }
        // ==== Дописать функционал при повторной регистрации того же пользователя ====
        // ==== Добавить функционал добавление аватарки ====
        return $out;
    }

    public static function login($login, $password) {
        global $DB;

        $out['status'] = 0;
        $out['message'] = "Ошибка входа. Что-то пошло не так!";
        $out['login'] = $login;

        $checkLogin_q = "SELECT * FROM `users` WHERE `users`.`login` = ?";

        $stmt = $DB->prepare($checkLogin_q);
        $stmt->bind_param("s", $login);
        $stmt->execute();

        $userData = $stmt->get_result()->fetch_assoc();

        if(md5(md5($password)) == $userData['password']) {
            $out['status'] = 1;
            $out['message'] = "Добро пожаловать! Чаю?";
        }

        return $out;
    }
}
