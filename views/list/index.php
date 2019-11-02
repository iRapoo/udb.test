<?php

if(!isset($_SESSION['user_data'])) {
    header('Location: /'); exit;
}

use Controllers\Users;

$view->title = 'Список пользователей';

$view->all_users = Users::get_users();

$view->user_data = $_SESSION['user_data'];