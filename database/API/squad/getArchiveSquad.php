<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/squad.php');

$db = new Database();
$db_conn = $db->connect();

$user = new SquadController($db_conn);

$user->getArchiveSquad();
?>