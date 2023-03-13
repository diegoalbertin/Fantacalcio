<?php 
include_once dirname(__FILE__) ."/url.php";

function getArchiveFoot(){
    $url = getPath()."API/football_player/getArchiveFoot.php";
    $data = file_get_contents($url);
    return json_decode($data);
}
?>