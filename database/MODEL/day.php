<?php
require("base.php");
class DayController extends BaseController
{
    public function getArchiveDay(){
        $query="SELECT DISTINCT *  from day;";
        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    } 

    public function getDay($id){
        $query="SELECT DISTINCT *  from day 
                where id=".$id.";";
        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    } 

    public function getNextDay($id_current_day){
        $id=$id_current_day+1;
        $query="SELECT DISTINCT *  from day 
        where id=".$id.";";
        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    }

    public function setDay($description,$game_date){
        $query="INSERT INTO day(description ,game_date) values ('$description',".$game_date.");";
        $result=$this->conn->query($query);
        return $result;
    }

    public function deleteDay($id){
        $query="DELETE from day where id=".$id.";";
        $result = $this->conn->query($query);
        return $result;
    }

    public function updateDayPlayed($id){
        $query = "UPDATE day set day.played = 1 where day.id=".$id.";";

        $result = $this->conn->query($query);
        return $result;
    }
}
?>