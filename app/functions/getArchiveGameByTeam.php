<?php 
include_once dirname(__FILE__) ."/url.php";

function getArchiveGameByTeam($id){
    $url = getPath()."API/game/getArchiveGameByTeam.php?TEAM_ID=".$id;
    $data = file_get_contents($url);
    return json_decode($data);
}
?>