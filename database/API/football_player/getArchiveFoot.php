<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/football_player.php');

$db = new Database();
$db_conn = $db->connect();

$foot = new FootballPlayerController($db_conn);

$foot->getArchiveFoot();
?>