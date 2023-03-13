
<?php
include_once dirname(__DIR__) . '/app/functions/getArchiveUser.php';
include_once dirname(__DIR__) . '/app/functions/setTeam.php';
include_once dirname(__DIR__) . '/app/functions/setUser.php';
session_start();

//session_unset();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['create'])) {

        if($_SESSION["n-user"]<=$_SESSION["totalUser"]){

            if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['psw']) && !empty($_POST['team-name'])){
                $data = [
                "name"=>$_POST['name'],
                "surname"=>$_POST['surname'],
                "email" => $_POST['email'],
                "psw" =>hash("sha256", $_POST['psw']),
                ];
                $array= array(
                    "data"=> $data,
                    "id-user"=>$_SESSION["n-user"],
                    "team-name"=>$_POST['team-name']);
                $_SESSION["data"][]=$array;
                $_SESSION["n-user"] =intval($_SESSION["n-user"])+1;        
            }
            else
            {
                echo '<script>alert("!! Campi incompleti !!")</script>';
            }
        }
    }

    if(isset($_POST['btn-user-number'])){
        $_SESSION['totalUser'] = $_POST['users-number'];
        $_SESSION["n-user"] =1;
    }
}
if($_SESSION["n-user"]>$_SESSION["totalUser"]){
    foreach($_SESSION["data"] as $sesh){
        setUser($sesh["data"]);
        $archiveUser=getArchiveUser();
        $lastInsert=end($archiveUser);
        setTeam($sesh["team-name"],$lastInsert->id);

    }
    echo '<script>alert("utenti e squadra creati")</script>';
    session_unset();
    header("Location:index.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../app/static/css/main.css">
        <title>sandwech</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body class="body">
        <?php if(!isset($_SESSION['totalUser']))
        {?>
        
        <div class="row">
            <div class="form-container bordered col-8 offset-2">
                <form class="text-center" method="post">
                    <label class="text-center" for="text">seleziona il numero delle squadre che potranno partecipare al campionato</label>
                    <div class="row">
                        <div>
                        <input class="" name="users-number" type="radio" value="4">
                        <label class="" for="text">4</label>
                        <input class="" name="users-number"s type="radio"value="6">
                        <label class="" for="text">6</label>
                        <input class="" name="users-number" type="radio" value="8">
                        <label class="" for="text">8</label>
                        </div>
                        <input type="submit" name="btn-user-number" value="avanti">
                    </div>
                </form>
            </div>
        </div>
        <?php }?>
        <div class="row">
                <div class="form-container bordered rounded col-8 offset-2">
                    <form class="text-center" method="post" name="form-user" action="">
                        <div class="row">
                            <label class="bold" for="text">user-<?php if(isset($_SESSION["n-user"])){
                                echo($_SESSION["n-user"]);}?></label>
                            <div class="text-center">
                                <div class="row">
                                    <label class="text-center" for="text">nome utente</label>                              
                                    <input class="col-6 offset-3" name="name" type="text"></div>
                                <div class="row">
                                    <label class="text-center" for="text">cognome utente</label>                              
                                    <input class="col-6 offset-3" name="surname" type="text"></div>
                                <div class="row">
                                    <label class="text-center" for="text">email</label>
                                    <input class="col-6 offset-3" name="email" type="email"></div>
                                <div class="row">
                                    <label class="text-center" for="text">password</label>
                                    <input class="col-6 offset-3" name="psw" type="text"></div>
                                <div class="row">
                                    <label class="text-center" for="text">nome Squadra</label>
                                    <input class="col-6 offset-3" name="team-name" type="text"></div>

                                <input type="submit" name="create" value="crea">

                            </div>
                    </form>
                </div>
            </div>     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    </body>
</html>