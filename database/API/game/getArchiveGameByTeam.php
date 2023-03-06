<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/game.php');

if(!isset($_GET['TEAM_ID'])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the TEAM_ID param"]);
    exit();
}

$id = explode("?TEAM_ID=", $_SERVER["REQUEST_URI"])[1];

if (empty($id)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid TEAM_ID"]);
    exit();
}

$db = new Database();
$db_conn = $db->connect();

$squad = new GameController($db_conn);

$squad->getArchiveGameByTeam($id);

?>