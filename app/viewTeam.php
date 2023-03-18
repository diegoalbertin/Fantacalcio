<?php
include_once dirname(__FILE__) . '/functions/checkLogin.php';
include_once dirname(__FILE__) . '/functions/getTeamByUser.php';
include_once dirname(__FILE__) . '/functions/getFootByTeam.php';

session_start();
$user = checkLogin();

$team=getTeamByUser($user[0]->id);
$_SESSION['team_id']=$team[0]->id;
$footballPlayers=getFootByTeam($_SESSION['team_id']);
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
            <h1 class="text-center">ROSA SQUADRA</h1>
        </div>
        <div class="row">
            <div class="col-6 offset-3">
                <table class="table table-primary">
                    <thead class="table-dark">
                        <th>nome</th>
                        <th>ruolo</th>
                    </thead>
                    <tbody>
                        <?php foreach($footballPlayers as $s){?>
                            <tr>
                                <th scope="row"><?php echo $s->name;?></th>
                                <td><?php echo $s->role;?></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
