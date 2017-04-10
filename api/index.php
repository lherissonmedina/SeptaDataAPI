<?php
include '../database.php';
header('Content-type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        break;
    case 'POST':
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
    default:
        break;
}


echo json_encode(array( "type" => $type ));


?>