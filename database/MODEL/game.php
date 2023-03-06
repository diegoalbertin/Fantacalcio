<?php
require("base.php");
class GameController extends BaseController
{
    /*
    -getGame(ID_Day,ID_Team1,ID_Team2)--
-getArchiveGame()--
-setGame()--
-getGameByTeam(ID_Team)--
-getGameByTeamAndDay(ID_Team,ID_Day)--
-getGameByDay(ID_Day)--
-getArchivePlayedGameByTeam(ID_Team)--
-getArchivePlayedGameByTeamAndDay(ID_Team,ID_Day)--
-getArchivePlayedGameByDay(ID_Day)--

    */
    public function getArchiveGame(){
        $query= "SELECT DISTINCT * FROM game;";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    }

    public function getGame($id_gameDay,$id_team1, $id_team2){
        $query = "SELECT DISTINCT * from game g
                  where g.id_day=".$id_gameDay." and g.id_team1=".$id_team1." and g.id_team2=".$id_team2." ;";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);         
    }

    public function getArchiveGameByTeamAndDay($id_team,$id_gameDay){
        $query = "SELECT DISTINCT * from game 
                  where id_day=".$id_gameDay." and id_team1=".$id_team." 
                  or id_day=".$id_gameDay." and id_team2=".$id_team.";";

        $result=$this->conn->query($query);

        $this->SendOutput($result, JSON_OK);         
    }

    public function getArchiveGameByTeam($id_team){
        $query = "SELECT DISTINCT * from game 
                  where id_team1=".$id_team."or id_team2=".$id_team.";";

        $result=$this->conn->query($query);

        $this->SendOutput($result, JSON_OK);         
    }

    public function getArchiveGameByDay($id_day){
        $query = "SELECT DISTINCT * from game 
                  where id_day=".$id_day.";";

        $result=$this->conn->query($query);

        $this->SendOutput($result, JSON_OK);         
    }
    
    public function getArchivePlayedGameByTeam($id_team){
        $query = "SELECT DISTINCT * from game g
                  inner join `day` d on  g.id_team1=".$id_team." and d.id = g.id_day and d.played = 1 or 
                  g.id_team2=".$id_team." and d.id = g.id_day and d.played = 1; ";

        $result=$this->conn->query($query);

        $this->SendOutput($result, JSON_OK);         
    }

    public function getArchivePlayedGameByTeamAndDay($id_team,$id_gameDay){
        $query = "SELECT DISTINCT * from game g
                  inner join `day` d on  g.id_team1=".$id_team." and g.id_day=".$id_gameDay." and d.id = g.id_day and d.played = 1 or 
                  g.id_team2=".$id_team." and g.id_day=".$id_gameDay." and d.id = g.id_day and d.played = 1; ";

        $result=$this->conn->query($query);

        $this->SendOutput($result, JSON_OK);         
    }

        
    public function getArchivePlayedGameByDay($id_gameDay){
        $query = "SELECT DISTINCT * from game g
                  inner join `day` d on  g.id_day=".$id_gameDay." and d.id = g.id_day and d.played = 1 ;";

        $result=$this->conn->query($query);

        $this->SendOutput($result, JSON_OK);         
    }


    public function setGame($id_gameDay,$id_team1,$id_team2){
        $query= "INSERT into game(id_day, id_team1, id_team2) value (".$id_gameDay.",".$id_team1.",".$id_team2.")";
        $result = $this->conn->query($query);
        return $result;
    }

    public function updateFormationPoints($id_gameDay,$id_foot,$points){
        $query = "UPDATE formation 
        SET points = ".$points." 
        WHERE id_day = ".$id_gameDay.", id_foot = ".$id_foot." ;";
        
        $result = $this->conn->query($query);
        return $result;
    }

    public function deleteGame($id_gameDay,$id_team){
        $query= "DELETE from game where id_day=".$id_gameDay." and id_team1=".$id_team." 
                or id_day=".$id_gameDay." and id_team2=".$id_team.";";
        $result = $this->conn->query($query);
        return $result;
    }

    public function deleteAllGame(){
        $query= "DELETE from game where 1=1;";
        $result = $this->conn->query($query);
        return $result;
    }

    


}
?>

