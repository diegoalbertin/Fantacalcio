<?php 
include_once dirname(__FILE__) ."/url.php";

function getArchiveDay(){
    $url = getPath()."API/day/getArchiveDay.php";
    $data = file_get_contents($url);
    return json_decode($data);
}
?>