<?php

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

use Controllers\Api;

switch ($_GET['method']) {
    case 'get_token':
        $data = Api::get_token();
        break;
    case 'get_users':
        $data = Api::get_users();
        break;
    case 'create_user':
        $data = Api::create_user();
        break;
    case 'delete_user':
        $data = Api::delete_user();
        break;
    case 'check_email':
        $data = Api::check_email();
        break;
    default:
        $data = 'Method not found';
        break;
}

echo json_encode($data);

