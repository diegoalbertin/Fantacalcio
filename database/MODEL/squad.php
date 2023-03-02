<?php
require("base.php");
class SquadController extends BaseController
{
    public function getArchiveSquad(){
        $query="SELECT DISTINCT *  from squad;";
        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    } 

    public function getFootByTeam($id_team){
        $query="SELECT DISTINCT id_foot  from squad 
                where squad.id_team =".$id_team." ;";
        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    }

    public function getTeamByFoot($id_foot){
        $query="SELECT DISTINCT id_team  from squad 
                where squad.id_foot =".$id_foot." ;";
        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    }

    public function setSquad($id_team,$id_foot){
        $query="INSERT INTO squad(id_team, id_foot) values (".$id_team.",".$id_foot.");";
        $result=$this->conn->query($query);
        return $result;
    }

    public function deleteSquad($id_team,$id_foot){
        $query="DELETE from squad where id_team=".$id_team." and id_foot = ".$id_foot.";";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>