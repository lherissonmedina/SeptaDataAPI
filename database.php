<?php
    $dbhost = $_SERVER['RDS_HOSTNAME'];
    $dbport = $_SERVER['RDS_PORT'];
    $dbname = $_SERVER['RDS_DB_NAME'];
    $username = $_SERVER['RDS_USERNAME'];
    $password = $_SERVER['RDS_PASSWORD'];
    $dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname}";
    
    function connection() {
        global $dbhost, $username, $password, $dbname;
        return new mysqli($dbhost, $username, $password, $dbname);
    }

    function getData($sql) {
        $conn = connection();
        
        if ($conn->connect_error) {
            return array( "error" => $conn->connect_error );
        }

        $result = $conn->query($sql);

        $response = array();
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
        } else {
            $response = array( "error" => "No Results Found");
        }

        $conn->close();
        return $response;
    }

    function insertData($sql) {
        $conn = connection();
            
        if ($conn->connect_error) {
            return array( "error" => $conn->connect_error );
        }

        if ($conn->query($sql) === TRUE) {
            $response = array( "success" => $conn->affected_rows);
        } else {
            $response = array( "error" => $conn->error );
        }

        $conn->close();
        return $response;
    }

    function removeData($sql) {
        $conn = connection();

        if ($conn->connect_error) {
            return array( "error" => $conn->connect_error );
        }

        if ($conn->query($sql) === TRUE) {
            $response =  array( "success" => $conn->affected_rows);
        } else {
            $response =  array( "error" =>  $conn->error);
        }

        $conn->close();
        return $response;
    }
