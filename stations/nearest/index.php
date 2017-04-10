<?php
    include '../../database.php';
    header('Content-type: application/json');

    $lat = $_GET['lat'];
    $lon = $_GET['lon'];
    $radius = $_GET['radius'] ?: 1;
    $type = $_GET['type'] ?: "Rapid-Transit";
    $limit = $_GET['limit'] ?: 5;

    if (isset($lat) && isset($lon)) {
        echo nearestStations($lat, $lon, $radius, $type, $limit);
    } else {
        echo json_encode(array( "error" => "Missing Arguments" ));
    }
    
    function nearestStations($lat, $lon, $radius, $type, $limit) {
        $formula = "(3959 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lon)) + sin(radians($lat)) * sin(radians(latitude))))";
        $sql = "SELECT stations.*, stops.id_line, stops.id_stop, septa_lines.name_long AS line, $formula AS distance ";
        $sql .= "FROM stations ";
        $sql .= "INNER JOIN stops ON stations.id_station=stops.id_station ";
        $sql .= "INNER JOIN septa_lines ON stops.id_line=septa_lines.id_line ";
        $sql .= "WHERE septa_lines.id_type='$type' ";
        $sql .= "HAVING distance < $radius ";
        $sql .= "ORDER BY distance ";
        $sql .= "LIMIT $limit";

        return json_encode(getData($sql));
    }

