<?php

namespace Controllers;

use Models\User;

class Users
{

    public static function get_users()
    {
        return User::all();
    }

}