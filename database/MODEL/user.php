<?php
require("base.php");
class UserCotroller extends BaseController
{
    public function getArchiveUser(){
        $query= "SELECT DISTINCT * FROM user;";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
    }

    public function getUser($id){
        $query = "SELECT DISTINCT * from user u
                  where u.id=".$id.";";

        $result=$this->conn->query($query);
        $this->SendOutput($result, JSON_OK);
                  
    }

    public function setUser($name,$surname,$email,$psw){
        $query= "INSERT into user(name, surname,email,psw) values('$name','$surname','$email','$psw');";
        
        $result=$this->conn->query($query);
        return $result;
    }

    public function deActiveUser($id){
        $query = sprintf("UPDATE user 
            SET active = 0 
            WHERE id = %d",
            $this->conn->real_escape_string($id)
        );

        $result = $this->conn->query($query);
        return $result;
    }
    public function reActiveUser($id){
        $query = sprintf("UPDATE user 
            SET active = 1 
            WHERE id = %d",
            $this->conn->real_escape_string($id)
        );

        $result = $this->conn->query($query);
        return $result;
    }

    public function updateUserCredits($credits,$id){
        $query = "UPDATE user set user.credits = ".$credits." where user.id=".$id.";";

        $result = $this->conn->query($query);
        return $result;
    }

    public function login($email, $password)
    {
        $sql = sprintf("SELECT email, password, id
        FROM `user`
        where 1=1 ");
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($this->conn->real_escape_string($email) == $this->conn->real_escape_string($row["email"]) && $this->conn->real_escape_string($password) == $this->conn->real_escape_string($row["psw"])) {
                return $this->conn->real_escape_string($row["id"]);
            }
        }

        return false;
    }
}
