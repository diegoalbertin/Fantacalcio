<?php 
include_once dirname(__FILE__) ."/url.php";

function getArchiveGame(){
    $url = getPath()."API/game/getArchiveGame.php";
    $data = file_get_contents($url);
    return json_decode($data);
}
?>