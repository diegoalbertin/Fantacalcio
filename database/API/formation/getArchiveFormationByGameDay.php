<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/formation.php');

if(!isset($_GET["GAMEDAY_ID"])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the id param"]);
    exit();
}

$id_gameDay =$_GET["GAMEDAY_ID"];

if (empty($id_team)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}


$db = new Database();
$db_conn = $db->connect();

$formation = new FormationController($db_conn);

$formation->getArchiveFormationByGameDay($id_gameDay);

?>