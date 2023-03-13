<?php 
include_once dirname(__FILE__) ."/url.php";

function getFootByTeam($id){
    $url = getPath()."API/squad/getFootByTeam.php?TEAM_ID=".$id;
    $data = file_get_contents($url);
    return json_decode($data);
}
?>
