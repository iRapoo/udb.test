<?php
require 'config.php';
require 'vendor/autoload.php';

use Models\Database;

$database = new Database();

$view = new ArrayObject();

require 'views/' . $_GET['view'] . '/template.php';