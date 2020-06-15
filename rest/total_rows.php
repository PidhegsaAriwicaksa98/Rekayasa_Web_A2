<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('api/Rest.php');
$api = new Rest();
switch($requestMethod) {
    case 'GET':
    $wstQ = '';
    if(isset($_GET["q"]) && $_GET["q"] == "web"){
        $wstQ = $_GET['q'];
    }
    $api->getWisata_total_rows($wstQ);
break;
default:
    header("HTTP/1.0 405 Method Not Allowed");
break;

}
?>