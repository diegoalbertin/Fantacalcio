<?php 
include_once dirname(__FILE__) ."/url.php";

function getFoot($id){
    $url = getPath()."API/football_player/getFoot.php?FOOT_ID=".$id;
    $data = file_get_contents($url);
    return json_decode($data);
}
?>
