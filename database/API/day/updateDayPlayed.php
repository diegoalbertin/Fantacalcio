<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("../../COMMON/connect.php");
require ('../../MODEL/day.php');

$database = new Database();
$db = $database->connect(); 

$data = json_decode(file_get_contents("php://input")); // Legge dati dalla request body
if (!empty($data) || !empty($data->id)) // Se qualcosa viene letto
{
    $team = new DayController($db);
    var_dump($team->updateDayPlayed($data->id));
    echo json_encode(array("Message" => "played updated to 1"));
}
else
{
    http_response_code(400);
    echo json_encode(array("Message" => "Bad request"));
}
die();
?>