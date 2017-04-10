<?php

    $location_type = array(
        "rail" => "rail_stations",
        "perks" => "perk_locations",
        "trolley" => "trolley_stops",
        "sales" => "sales_locations",
    );

    echo nearbyLocations($_POST['lat'], $_POST['lon'], $_POST['radius']);

    function nearbyLocations($lat, $lon, $radius) {
        global $location_type;
        $url = "http://www3.septa.org/hackathon/locations/get_locations.php?lat=$lat&lon=$lon&type=".$location_type['rail']."&radius=$radius";
        
        $json = file_get_contents($url);
        $objects = json_decode($json, true);
        
        $stations = array();
        foreach ($objects as $object) {
            $name = $object["location_name"];
            $id = $object["location_id"];
            $lat = $object["location_lat"];
            $lon = $object["location_lon"];
            $distance = $object["distance"];
            $station = array('name' => $name, 'id' => $id, 'latitude' => $lat, 'longitude' => $lon, 'distance' => $distance);
            $stations[] = $station;
        }
        header('Content-type: application/json');
        return json_encode($stations);
    }
?>