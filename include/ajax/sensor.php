<?php
$root = $_SERVER['DOCUMENT_ROOT']."/MIXR/";
require $root."libs/service.php";
session_start();
$service = new Service();

if(!isset($_COOKIE['design_type'])) {
    $jsonArray['status'] = true;
    $jsonArray['daytime'] = $service->IsDaytime(new IsDaytime())->IsDaytimeResult;
} else {
    $jsonArray['status'] = false;
    $jsonArray['daytime'] = $_COOKIE['design_type'];
}
echo json_encode($jsonArray);
?>