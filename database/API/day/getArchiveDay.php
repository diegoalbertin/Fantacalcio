<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/day.php');

$db = new Database();
$db_conn = $db->connect();

$day = new DayController($db_conn);

$day->getArchiveDay();

?>