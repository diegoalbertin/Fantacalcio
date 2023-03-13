<?php
include_once dirname(__FILE__) . '/functions/checkLogin.php';
include_once dirname(__FILE__) . '/functions/getStandings.php';
include_once dirname(__FILE__) . '/functions/getArchiveTeam.php';
include_once dirname(__FILE__) . '/functions/getArchiveFoot.php';
include_once dirname(__FILE__) . '/functions/getTeam.php';

session_start();

if(isset($_SESSION['data']))
unset($_SESSION['data']);

$_SESSION['user_id']=4;
$user = checkLogin();
$team=getArchiveTeam();
$foot=getArchiveFoot();
$_SESSION['n-team']=0;
$_SESSION['totalTeam']=count($team);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['create'])) {

        if($_SESSION["n-team"]<=$_SESSION["totalTeam"]){

            if(count($_POST['foot'])!=15){
                $data= array(
                    "foot_id"=> $_POST['foot'],
                    "id-user"=>$_SESSION["n-team"]);
                $_SESSION["data"][]=$data;
                var_dump($_SESSION["data"]);
                //$_SESSION["n-team"] =intval($_SESSION["n-team"])+1;       
            }
            else
            {
                echo '<script>alert("!! Campi incompleti !!")</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" href="static/css/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    </head>
    <body>
        <div class="row">
            <div class="box-selectedFoot" style="background-color: grey; min-height:30px;">

            </div>
        </div>
        <div class="row">
            <div><h1 onclick="hideShow()">></h1></div>
                <div class="form-container bordered rounded col-8 offset-2" id="div-form" style="display:block;">
                    <form class="text-center" method="post" name="form-team" action="">
                        <div class="row">
                            <label class="bold" for="text">team-<?php if(isset($_SESSION["n-team"])){
                                echo $team[intval($_SESSION['n-team'])]->name;}?></label>
                            <div class="text-center">
                                <?php foreach($foot as $f){?>
                                    
                                <div class="row">
                                    <div class="form-element">
                                    <input class="col-3 foot" name="foot[]" style="" onclick="selectFoot(<?php echo $f->id; ?>,'<?php echo $f->name; ?>')" type="checkbox" value="<?php echo $f->id; ?>">
                                    <label class="text-center col-3 offset-1" for="<?php echo $f->name; ?>"><?php echo $f->name; ?></label>                              
                                    <label class="text-center col-3 " for="text"><?php echo $f->team; ?></label>                              
                                    </div>
                                </div>
                                <?php }?>
                                <input type="submit" name="create" value="crea">
                            </div>
                    </form>
                </div>
            </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        function hideShow(){
            const elem = document.getElementById('div-form');
            console.log(elem.style.display);

            if(elem.style.display=='none!important'||elem.style.display=='none'){
                elem.style.display='block';
            }else if(elem.style.display=='block'){
                elem.style.display='none';  
            }
        }

        const idSelectedFoot=[];
        const nameSelectedFoot = [];
        let delId=0;
        let delName="";

        function selectFoot(id, name){
            if(idSelectedFoot.includes(id)==false||idSelectedFoot.length==0||idSelectedFoot.length<=15){

                idSelectedFoot.push(id);
                nameSelectedFoot.push(name);

            }else if(idSelectedFoot.includes(id)==true||idSelectedFoot.length>0||idSelectedFoot.length<=15){
                delId=id;
                delName=name;

                const tmpId = idSelectedFoot.filter(filterId);
                const tmpName =nameSelectedFoot.filter(filterName);

                idSelectedFoot.splice(0,idSelectedFoot.length);
                nameSelectedFoot.splice(0,nameSelectedFoot.length);

                for( i=0;i<tmpId.length;i++){
                    idSelectedFoot.push(tmpId[i]);
                    nameSelectedFoot.push(tmpName[i]);
                }

                delId=0;
                delName="";
            }
        }

        function filterId(id){
            if(id!=delId){
                return id;
            };
        }
        function filterName(name){
            return name!=delName;
        }

        function displaySelectedFoot(){
            for(i=0;i<nameSelectedFoot.length;i++){

            }
        }
        //disabilitare click dop 15 selezioni
        const input = document.querySelectorAll('.foot');

        for(const inp of input){
            inp.addEventListener('click',updateDisplay );
        }
        function updateDisplay() {
        let checkedCount = 0;
        for (const inp of input) {
            if (inp.checked) {
            checkedCount++;
            }
        }
        console.log(checkedCount);
        if(checkedCount==15){
            disable_cb();
        }else{
            enable_cb();
        }
        }

        function disable_cb(){
            for (const inp of input) {
            if (inp.checked!=true) {
            inp.disabled= true;
            }
        }
        }
        function enable_cb(){
            for (const inp of input) {
            inp.disabled=false;
            }
        }

    </script>
    </body>
</html>
