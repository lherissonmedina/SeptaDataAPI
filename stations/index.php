<?php
    include '../database.php';
    header('Content-type: application/json');
    
    echo allStations();

    function allStations() {
        $sql = "SELECT stations.*, stops.id_stop, septa_lines.name_long AS line
        FROM stations
        INNER JOIN stops on stations.id_station=stops.id_station
        INNER JOIN septa_lines ON stops.id_line=septa_lines.id_line
        WHERE septa_lines.id_type='Rapid-Transit'";
        
        return json_encode(getData($sql));
    }

?>