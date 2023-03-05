<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("../../COMMON/connect.php");
require ('../../MODEL/formation.php');

$database = new Database();
$db = $database->connect(); 

$data = json_decode(file_get_contents("php://input")); // Legge dati dalla request body
if (!empty($data) || !empty($data->id_gameDay) || !empty($data->id_foot)|| !empty($data->points) ) // Se qualcosa viene letto
{
    $formation = new FormationController($db);
    var_dump($formation->updateFormationPoints($data->id_gameDay, $data->id_foot, $data->points));
    echo json_encode(array("Message" => "points updated"));
}
else
{
    http_response_code(400);
    echo json_encode(array("Message" => "Bad request"));
}
die();
?>