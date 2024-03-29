<?php
include_once dirname(__FILE__) . '/functions/checkLogin.php';
include_once dirname(__FILE__) . '/functions/getStandings.php';
include_once dirname(__FILE__) . '/functions/getArchiveUser.php';
include_once dirname(__FILE__) . '/functions/getArchiveSquad.php';

session_start();
$archiveUser=getArchiveUser();
if(empty($archiveUser)){
    header('Location: startChampionship.php');
}
$user = checkLogin();
$standings = getStandings();

?>

<!DOCTYPE html>
<html>

    <head>
        <title>fantacalcio</title>
        <link rel="stylesheet" href="static/css/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div class="row">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">FANTACALCIO</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="viewTeam.php">rosa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">giornate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">le tue partite</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">formazioni</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
        </div>

        <?php if($_SESSION['user_id']==$archiveUser[0]->id){
                $archiveSquad=getArchiveSquad();
                if(empty($archiveSquad)){?>
                <div class=row>
                    <div class="warning-container text-center">
                        <a class="txt-decoration-none" href="insertTeamFoot.php">!!! inserisci i giocatori delle squadre !!!</a>
                    </div>
                </div>
            <?php } }?>
        <div class="row">
            <div class="standings-title form-element text-center">
                <h1>Classifica</h1>
            </div>
            <div class="standings-container border-solid rounded col-6 offset-3" >
                <table class="table text-center" style="border-radius: 10px;">
                    <thead >
                        <th>nome</th>
                        <th>ruolo</th>
                    </thead>
                    <tbody>
                    <?php foreach($standings as $s){?>
                            <tr>
                                <td scope="row"><?php echo $s->name;?></td>
                                <td><?php echo $s->points;?></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
