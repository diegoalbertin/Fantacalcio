<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("../../COMMON/connect.php");
require ('../../MODEL/squad.php');

$database = new Database();
$db = $database->connect(); 

$data = json_decode(file_get_contents("php://input")); // Legge dati dalla request body
if (!empty($data) || !empty($data->team)|| !empty($data->foot)) // Se qualcosa viene letto
{
    $squad = new SquadController($db);
    var_dump($squad->setSquad($data->team, $data->foot));
    echo json_encode(array("Message" => "Created"));
}
else
{
    http_response_code(400);
    echo json_encode(array("Message" => "Bad request"));
}
die();
?>