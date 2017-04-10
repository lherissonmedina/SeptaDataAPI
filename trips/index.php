<?php
    include '../database.php';
    include '../errors.php';

    header('Content-type: application/json');

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            if (isset($_GET['udid'])) {
                $sql = "SELECT * FROM trips WHERE id_user = '" . $_GET['udid'] . "'";

                echo json_encode(getData($sql));

            } elseif(isset($_GET['id'])){
                $sql = "SELECT * FROM trips WHERE id_trip = '" . $_GET['id'] . "'";

                echo json_encode(getData($sql));
            } else {
                sendError("No Parameters Given");
            }
            break;

        case 'POST':
            $udid = $_POST['udid'];
            $origin = $_POST['origin'];
            $destination = $_POST['destination'];
            $depart = $_POST['depart'];
            $arrival = $_POST['arrival'];

            if (isset($udid, $origin, $destination, $depart, $arrival)) {
                $values = "('" . $_POST['udid'] . "'," . $_POST['origin'] . ",'" . $_POST['depart'] . "'," . $_POST['destination'] . ", '" . $_POST['arrival'] . "')";
                $sql = "INSERT INTO trips (id_user, id_station_origin, time_departure, id_station_destination, time_arrival) VALUES " . $values;
                echo json_encode(insertData($sql));
            } else {
                sendError("No Parameters Given");
            }

            break;

        case 'DELETE':
            if (isset($_GET['id'])) {
                $sql = "DELETE FROM trips WHERE id_trip = '" . $_GET['id'] . "'";

                echo json_encode(removeData($sql));

            } elseif(isset($_GET['udid'])) {
                $sql = "DELETE FROM trips WHERE id_user = '" . $_GET['udid'] . "'";

                echo json_encode(removeData($sql));
            } else {
                sendError("No Parameters Given");
            }
            break;
        default:
            break;
    }



