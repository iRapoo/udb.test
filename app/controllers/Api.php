<?php

namespace Controllers;

use Models\Token;
use Models\User;

class Api
{

    public static function get_token()
    {
        $result = ['code' => 0];

        if (isset($_GET['key'])) {

            $token = self::genToken();

            $newToken = new Token();

            $newToken->token = $token;
            $newToken->key = $_GET['key'];

            if ($newToken->save())
                $result = [
                    'code' => 1,
                    'token' => $token
                ];
            else $result['message'] = 'Ошибка регистрации токена';
        } else {
            $result['message'] = 'Необходимо передать параметр "key"';
        }

        return $result;
    }

    public static function get_users()
    {
        $result = ['code' => 0];

        $response = self::checkToken($_GET['token']);

        if ($response) {
            $result = [
                'code' => 1,
                'result' => User::all()
            ];
        } else {
            $result['message'] = 'Заданный Token более не действителен или не существует';
        }

        return $result;
    }

    public static function create_user()
    {
        $result = ['code' => 0];

        $response = self::checkToken($_POST['token']);

        if ($response) {

            if (Users::create_user($_POST)) {
                unset($_POST['token']);
                $result = [
                    'code' => 1,
                    'result' => $_POST
                ];
            } else {
                $result['message'] = 'Ошибка, возможно пользователь с таким email уже существует';
            }

        } else {
            $result['message'] = 'Заданный Token более не действителен или не существует';
        }

        return $result;
    }

    public static function delete_user()
    {
        $result = ['code' => 0];

        $response = self::checkToken($_POST['token']);

        if ($response) {

            if (User::where('id', $_POST['id'])->delete()) {
                $result = [
                    'code' => 1,
                    'message' => 'Пользователь с id = ' . $_POST['id'] . ' успешно удален!'
                ];
            } else {
                $result['message'] = 'Ошибка удаления пользователя';
            }

        } else {
            $result['message'] = 'Заданный Token более не действителен или не существует';
        }

        return $result;
    }

    public static function check_email()
    {
        $user = User::where('email', $_POST['email'])->get();

        if(count($user) > 0)
        {
            return $res = [
                'state' => 0,
                'message' => 'Email "'. $_POST['email'] .'" уже занят'
            ];
        } else {
            return $res = [
                'state' => 1,
                'message' => 'Email адрес доступен'
            ];
        }
    }

    private static function checkToken($token)
    {
        $date = new \DateTime();
        $date->modify('-1 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        return Token::where('token', $token)
            ->where('created_at', '>', $formatted_date)
            ->latest()->get()[0];
    }

    private static function genToken()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 25; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }

}