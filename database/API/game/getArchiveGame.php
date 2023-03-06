<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/game.php');

$db = new Database();
$db_conn = $db->connect();

$squad = new GameController($db_conn);

$squad->getArchiveGame();

?>