<?php 
include_once dirname(__FILE__) ."/url.php";

function getFootIdByTeam($id){
    $url = getPath()."API/team/getFootIdByTeam.php?TEAM_ID=".$id;
    $data = file_get_contents($url);
    return json_decode($data);
}
?>
