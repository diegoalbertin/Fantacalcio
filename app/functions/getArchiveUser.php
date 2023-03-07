<?php 
include_once dirname(__FILE__) ."/url.php";

function getArchiveUser(){
    $url = getPath()."API/user/getArchiveUser.php";
    $data = file_get_contents($url);
    return json_decode($data);
}
?>