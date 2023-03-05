<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/formation.php');

if(!isset($_GET["GAMEDAY_ID"])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the id param"]);
    exit();
}

$id_gameDay =$_GET["GAMEDAY_ID"];

if (empty($id_gameDay)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}

if(!isset($_GET["FOOT_ID"])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the id param"]);
    exit();
}

$id_foot = $_GET["FOOT_ID"];

/*$a=explode("?GAMEDAY_ID=",$_SERVER['REQUEST_URI']);
$b=explode("&FOOT_ID=",$a[1]);
var_dump($b[0]);
var_dump($b[1]);*/

if (empty($id_foot)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}

$db = new Database();
$db_conn = $db->connect();

$formation = new FormationController($db_conn);

$formation->getFormation($id_gameDay,$id_foot);

?>