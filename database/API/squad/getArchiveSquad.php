<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/squad.php');

$db = new Database();
$db_conn = $db->connect();

$squad = new SquadController($db_conn);

$squad->getArchiveSquad();
?>