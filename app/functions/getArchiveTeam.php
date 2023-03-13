<?php 
include_once dirname(__FILE__) ."/url.php";

function getArchiveTeam(){
    $url = getPath()."API/team/getArchiveTeam.php";
    $data = file_get_contents($url);
    return json_decode($data);
}
?>