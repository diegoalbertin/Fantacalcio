<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/formation.php');

if(!isset($_GET["FOOT_ID"])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the id param"]);
    exit();
}

$id_foot =$_GET["FOOT_ID"];

if (empty($id_team)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}


$db = new Database();
$db_conn = $db->connect();

$formation = new FormationController($db_conn);

$formation->getArchiveFormationByFoot($id_foot);

?>