<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("../../COMMON/connect.php");
require ('../../MODEL/team.php');

$database = new Database();
$db = $database->connect(); 

$data = json_decode(file_get_contents("php://input")); // Legge dati dalla request body
if (!empty($data) || !empty($data->team_id) || !empty($data->points)) // Se qualcosa viene letto
{
    $team = new TeamCotroller($db);
    var_dump($team->updateTeamPoints($data->team_id, $data->points));
    echo json_encode(array("Message" => "points updated"));
}
else
{
    http_response_code(400);
    echo json_encode(array("Message" => "Bad request"));
}
die();
?>