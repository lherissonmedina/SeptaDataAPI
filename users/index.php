<?php
    include '../database.php';
    include '../errors.php';

    header('Content-type: application/json');

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            if (isset($_GET['udid'])) {
                $sql = "SELECT id_user FROM users WHERE id_user = '".$_GET['udid']."'";

                echo json_encode(getData($sql));

            } else {
                sendError("No Parameters Given");
            }
            break;

        case 'POST':
            if (isset($_POST['udid'])) {
                $sql = "INSERT INTO users (id_user) VALUES ('".$_POST['udid']."')";
                echo json_encode(insertData($sql));
            } else {
                sendError("No Parameters Given");
            }
            break;

        case 'DELETE':
            if (isset($_GET['udid'])) {

                $sql = "DELETE FROM users WHERE id_user = '".$_GET['udid']."'";

                echo json_encode(removeData($sql));

            } else {
                sendError("No Parameters Given");
            }
            break;
        default:
            break;
    }


