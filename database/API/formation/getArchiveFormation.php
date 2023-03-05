<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/formation.php');

$db = new Database();
$db_conn = $db->connect();

$foot = new FormationController($db_conn);

$foot->getArchiveFormation();
?>