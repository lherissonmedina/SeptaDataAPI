<?php
include '../database.php';
include '../errors.php';

header('Content-type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $origin = $_GET['origin'];
        $destination = $_GET['destination'];
        $day = $_GET['day'];

        if (isset($origin, $destination, $day)) {
            $sql = "SELECT
DATE_FORMAT(a.time_departure,'%h:%i %p') AS `Departure`,
DATE_FORMAT(b.time_departure,'%h:%i %p') AS `Arrival`,
station_a.name_long AS 'Origin',
station_b.name_long AS 'Destination',
septa_lines.name_long AS 'Line'

FROM test_schedules a
INNER JOIN test_schedules b ON a.id_stop != b.id_stop and a.day = b.day and a.direction = b.direction and a.train = b.train
INNER JOIN septa.stops stop_a ON a.id_stop = stop_a.`id_septa_stop`
INNER JOIN septa.stops stop_b ON b.id_stop = stop_b.`id_septa_stop`
INNER JOIN stations station_a ON stop_a.id_station = station_a.`id_station` and station_a.id_station = $origin
INNER JOIN stations station_b ON stop_b.id_station = station_b.`id_station` and station_b.id_station = $destination
INNER JOIN septa.septa_lines ON stop_a.id_line = septa_lines.`id_line`
WHERE
a.time_departure >= CONVERT_TZ(now(), 'UTC','US/Eastern')
AND
a.day = '$day'
AND 
a.time_departure <= b.time_departure

ORDER BY a.time_departure";

            echo json_encode(getData($sql));

        } else {
            sendError("No Parameters Given");
        }
        break;
    default:
        break;
}



