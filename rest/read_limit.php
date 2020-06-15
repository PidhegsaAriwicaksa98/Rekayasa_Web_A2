<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('api/Rest.php');
$api = new Rest();
switch($requestMethod){
    case 'GET':
        $wstLimit = $_GET['limit'];
        $wstStart = $_GET['start'];
        $wstQ = NULL;
        if($_GET['q']) {
            $wstQ = $_GET['q'];
        }
        $api->getWisata_limit($wstLimit, $wstStart, $wstQ);
    break;
default:
    header("HTTP/1.0 405 Method Not Allowed");
break;

}
?>