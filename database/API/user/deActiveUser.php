<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/user.php');

if(!isset($_GET['USER_ID'])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the id param"]);
    exit();
}

$id = explode("?USER_ID=", $_SERVER["REQUEST_URI"])[1];

if (empty($id)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}

$db = new Database();
$db_conn = $db->connect();

$user = new UserCotroller($db_conn);
$user->deActiveUser($id);
?>