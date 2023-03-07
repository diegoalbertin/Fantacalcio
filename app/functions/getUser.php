<?php 
include_once dirname(__FILE__) ."/url.php";

function getUser($id){
    $url = getPath()."API/user/getUser.php?USER_ID=".$id;
    $data = file_get_contents($url);
    return json_decode($data);
}
?>