<?php 
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('api/Rest.php');
$api = new Rest();
switch($requestMethod) {
	case 'GET':
		$wstId = '';
		if(isset($_GET["id"]) && $_GET["id"] == "web") {
			$wstId = $_GET['id'];
		}
		$api->getWisata($wstId);
		break;
	default:
		header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>