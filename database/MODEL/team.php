<?php
require("base.php");
class TeamCotroller extends BaseController
{
    public function getArchiveTeam(){
        $query= "SELECT DISTINCT * FROM team order by id;";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    }

    public function getStandings(){
        $query= "SELECT DISTINCT * FROM team ORDER BY points desc;";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    }

    public function getTeam($id){
        $query = "SELECT DISTINCT * from team t
                  where t.id=".$id.";";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);         
    }

    public function getTeamByUser($id){
        $query = "SELECT DISTINCT id from team t
                  where t.id_user=".$id.";";
        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);         
    }

    public function setTeam($user_id,$name){
        $query= "INSERT into team(id_user, name) value (".$user_id.",'$name')";
        $result = $this->conn->query($query);
        return $result;
    }

    public function updateTeamPoints($id,$points){
        $query = sprintf("UPDATE team 
        SET points = ".$points." 
        WHERE id = %d",
        $this->conn->real_escape_string($id)
        );
        
        $result = $this->conn->query($query);
        return $result;
    }
}
?>