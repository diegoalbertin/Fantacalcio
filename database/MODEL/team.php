<?php
require("base.php");
class TeamCotroller extends BaseController
{
    public function getArchiveTeam(){
        $query= "SELECT DISTINCT * FROM team;";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    }

    public function getTeam($id){
        $query = "SELECT DISTINCT * from team t
                  where t.id=".$id.";";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);         
    }

    public function setTeam($user_id,$name){
        $query= "INSERT into team(user_id, name) value (".$user_id.",'$name')";
        $result = $this->conn->query($query);
        return $result;
    }

    public function updateTeamPoints($id,$points){
        $query = sprintf("UPDATE team 
        SET points = %d 
        WHERE id = %d",
        $this->conn->real_escape_string($points,$id)
        );
        
        $result = $this->conn->query($query);
        return $result;
    }
}
?>