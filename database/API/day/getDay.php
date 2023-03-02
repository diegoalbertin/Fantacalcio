<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/day.php');

if(!isset($_GET['DAY_ID'])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the id param"]);
    exit();
}

$id = explode("?DAY_ID=", $_SERVER["REQUEST_URI"])[1];

if (empty($id)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}

$db = new Database();
$db_conn = $db->connect();

$day = new DayController($db_conn);

$day->getDay($id);

?>