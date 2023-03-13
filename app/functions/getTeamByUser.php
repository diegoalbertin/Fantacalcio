<?php 
include_once dirname(__FILE__) ."/url.php";

function getTeamByUser($id){
    $url = getPath()."API/team/getTeamByUser.php?USER_ID=".$id;
    $data = file_get_contents($url);
    return json_decode($data);
}
?>