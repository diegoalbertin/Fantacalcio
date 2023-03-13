<?php 
include_once dirname(__FILE__) ."/url.php";

function getStandings(){
    $url = getPath()."API/team/getStandings.php";
    $data = file_get_contents($url);
    return json_decode($data);
}
?>