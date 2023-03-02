<?php
require("base.php");
class FootballPlayerController extends BaseController
{
    public function getArchiveFoot(){
        $query="SELECT DISTINCT *  from football_player;";
        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    } 

    public function getFoot($id){
        $query="SELECT DISTINCT *  from football_player 
                where id=".$id.";";
        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    } 


    public function setFoot($name,$team,$role,$quotation,$midfielder){
        $query="INSERT INTO football_player(name, team, role, quotation, midfielder) values ('$name','$team','$role','$quotation','$midfielder');";
        $result=$this->conn->query($query);
        return $result;
    }

    public function deleteFoot($id){
        $query="DELETE from football_player where id=".$id.";";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>