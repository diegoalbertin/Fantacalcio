<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("../../COMMON/connect.php");
require ('../../MODEL/user.php');

$database = new Database();
$db = $database->connect(); 

$data = json_decode(file_get_contents("php://input")); // Legge dati dalla request body
if (!empty($data) || !empty($data->name)|| !empty($data->surname)|| !empty($data->email)|| !empty($data->psw)) // Se qualcosa viene letto
{
    $user = new UserCotroller($db);
    var_dump($user->setUser($data->name, $data->surname,$data->email,$data->psw));
    echo json_encode(array("Message" => "Created"));
}
else
{
    http_response_code(400);
    echo json_encode(array("Message" => "Bad request"));
}
die();
?>