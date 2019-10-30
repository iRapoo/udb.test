<?php
require "config.php";
require "vendor/autoload.php";

use Models\Database;
use Controllers\Users;

$dt = new Database();

echo Users::get_users();