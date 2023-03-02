<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/squad.php');

if(!isset($_GET['FOOT_ID'])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the FOOT_ID param"]);
    exit();
}

$id = explode("?FOOT_ID=", $_SERVER["REQUEST_URI"])[1];

if (empty($id)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid FOOT_ID"]);
    exit();
}

$db = new Database();
$db_conn = $db->connect();

$user = new SquadController($db_conn);

$user->getTeamByFoot($id);

?>