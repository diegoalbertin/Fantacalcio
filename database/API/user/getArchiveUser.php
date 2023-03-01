<?php 
require("../../COMMON/connect.php");
require ('../../MODEL/user.php');

$db = new Database();
$db_conn = $db->connect();

$user = new UserCotroller($db_conn);

$user->getArchiveUser();
?>