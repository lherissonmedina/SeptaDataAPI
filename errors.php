<?php
/**
 * Created by PhpStorm.
 * User: Lherisson
 * Date: 2/28/17
 * Time: 8:22 PM
 */

function sendError($message) {
    echo json_encode(array( "error" => "No Parameters Given" ));
}