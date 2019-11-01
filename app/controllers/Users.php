<?php

namespace Controllers;

use Models\User;

class Users
{
    private static $upload_dir = '/storage/';

    public static function get_users()
    {
        return User::all();
    }

    public static function create_user($user_data)
    {

        $users = User::where('email', $user_data['email'])->get();

        if (count($users) > 0) return false;

        $user_data['photo'] = (new Users)->upload_file();
        $user_data['key'] = (new Users)->genKey();

        $user = new User();

        $user->name = $user_data['name'];
        $user->email = $user_data['email'];
        $user->photo = $user_data['photo'];
        $user->key = $user_data['key'];

        return ($user->save()) ? $user_data : false;
    }

    public static function verify_user($key)
    {
        $user = User::where('key', $key)->get();

        if(count($user) > 0) {
            $update = User::where('id', $user[0]['id'])->update(['active'=>1]);
            return ($update) ? $user[0] : false;
        }

        return false;
    }

    private function genKey()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }

    private function upload_file()
    {
        $uploadfile = $_SERVER['DOCUMENT_ROOT'] . self::$upload_dir . basename($_FILES['photo']['name']);

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile))
            return $_FILES['photo']['name'];
        else return null;
    }

}