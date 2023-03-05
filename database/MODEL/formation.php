<?php
require("base.php");
class FormationController extends BaseController
{
    public function getArchiveFormation(){
        $query= "SELECT DISTINCT * FROM formation;";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    }

    public function getFormation($id_gameDay,$id_foot){
        $query = "SELECT DISTINCT * from formation f
                  where f.id_gameDay=".$id_gameDay." and f.id_foot=".$id_foot.";";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);         
    }

    public function getArchiveFormationByFoot($id_foot){
        $query = "SELECT DISTINCT * from formation f
                  where f.id_foot=".$id_foot.";";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);         
    }

    public function getArchiveFormationByGameDay($id_gameDay){
        $query = "SELECT DISTINCT * from formation f
                  where f.id_gameDay=".$id_gameDay.";";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);         
    }

    public function getArchiveFormationByTeam($id_team){
        $query = "SELECT DISTINCT * from formation f
                  where f.id_team=".$id_team.";";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);         
    }
    
    public function setFormation($id_gameDay,$id_foot,$id_team){
        $query= "INSERT into formation(id_gameDay, id_foot, id_team) value (".$id_gameDay.",".$id_foot.",".$id_team.")";
        $result = $this->conn->query($query);
        return $result;
    }

    public function updateFormationPoints($id_gameDay,$id_foot,$points){
        $query = "UPDATE formation 
        SET points = ".$points." 
        WHERE id_gameDay = ".$id_gameDay.", id_foot = ".$id_foot." ;";
        
        $result = $this->conn->query($query);
        return $result;
    }

    public function deleteFormation($id_gameDay,$id_foot){
        $query= "DELETE from day where id_gameDay=".$id_gameDay." and id_foot=".$id_foot.";";
        $result = $this->conn->query($query);
        return $result;
    }


}
?>