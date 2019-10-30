<?php

use Controllers\Users;

$view->title = 'Список пользователей';

$view->all_users = Users::get_users();