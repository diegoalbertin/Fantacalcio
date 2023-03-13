<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/team.php');

$db = new Database();
$db_conn = $db->connect();

$team = new TeamCotroller($db_conn);

$team->getStandings();

?>