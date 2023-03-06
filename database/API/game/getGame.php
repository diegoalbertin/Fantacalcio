<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/game.php');

if(!isset($_GET['GAMEDAY_ID'])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the TEAM_ID param"]);
    exit();
}

$id_gameDay = explode("?GAMEDAY_ID=", $_SERVER["REQUEST_URI"])[1];

if(!isset($_GET['TEAM1_ID'])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the TEAM_ID param"]);
    exit();
}

$id_team1 = explode("?TEAM1_ID=", $_SERVER["REQUEST_URI"])[1];

if(!isset($_GET['TEAM2_ID'])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the TEAM_ID param"]);
    exit();
}

$id_team2 = explode("?TEAM1_ID=", $_SERVER["REQUEST_URI"])[1];


if (empty($id_team2)||empty($id_team1)||empty('GAMEDAY_ID')) {
    http_response_code(404);
    echo json_encode(["message" => "incorrect params"]);
    exit();
}

$db = new Database();
$db_conn = $db->connect();

$squad = new GameController($db_conn);

$squad->getGame($id_gameDay,$id_team1,$id_team2);

?>