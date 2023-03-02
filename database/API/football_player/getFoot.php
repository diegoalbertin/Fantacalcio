<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/football_player.php');

if(!isset($_GET['FOOT_ID'])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the id param"]);
    exit();
}

$id = explode("?FOOT_ID=", $_SERVER["REQUEST_URI"])[1];

if (empty($id)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}

$db = new Database();
$db_conn = $db->connect();

$foot = new FootballPlayerController($db_conn);

$foot->getFoot($id);

?>