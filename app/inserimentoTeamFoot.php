<?php
include_once dirname(__FILE__) . '/functions/checkLogin.php';
include_once dirname(__FILE__) . '/functions/getStandings.php';
include_once dirname(__FILE__) . '/functions/getArchiveUser.php';
include_once dirname(__FILE__) . '/functions/getArchiveTeam.php';
include_once dirname(__FILE__) . '/functions/getArchiveFoot.php';
include_once dirname(__FILE__) . '/functions/getTeam.php';
include_once dirname(__FILE__) . '/functions/setSquad.php';

session_start();

$user = checkLogin();
$totalUser=getArchiveUser();

if($_SESSION['user_id']!=$totalUser[0]->id){
    echo '<script>alert("sezione privata")</script>';
    header("Location:index.php");
}

$ArchiveTeam=getArchiveTeam();

$foot=getArchiveFoot();

if(!isset($_SESSION['n-team'])){
$_SESSION['n-team']=0;}

$_SESSION['totalTeam']=count($ArchiveTeam);
//gesttione delle post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['create'])) {

        if($_SESSION["n-team"]<$_SESSION["totalTeam"]){

            if(count($_POST['foot'])==3){
                $data=array();

                foreach($_POST['foot'] as $f){
                    $p = array(
                        "team"=>$ArchiveTeam[$_SESSION['n-team']]->id,
                        "foot"=> $f,
                    ); 
                    array_push($data,$p);
                }
                $_SESSION["data"][]=$data;
                $_SESSION["n-team"] =intval($_SESSION["n-team"])+1;       
            }
            else
            {
                echo '<script>alert("!! Campi incompleti !!")</script>';
            }
        }
        else if($_SESSION["n-team"]==$_SESSION["totalTeam"]){
            foreach($_SESSION["data"] as $sesh){
                setSquad($sesh['data']);
            }
            echo '<script>alert("calciatori aggiunti alle squadra ")</script>';
            unset($_SESSION['data']);
            unset($_SESSION["n-team"]);
            unset($_SESSION["totalTeam"]);
            header("Location:index.php");
        }
    }
}
function displayFoot($foot){ //elimina i giocatori già selezionati
    if(isset($foot)){
        $unselectedFoot=array();

        foreach($foot as $f){
            $ctr = 1;
            foreach($_SESSION["data"] as $sesh){

                foreach($sesh as $ses){

                    if(intval($f->id)==intval($ses['foot'])){
                        $ctr = 0;
                    }
                }
            }
            if($ctr==1){
                array_push($unselectedFoot,$f);
            }
            else{
                //var_dump($f);
            }
        }
        return $unselectedFoot;
    }

}
if(isset($_SESSION['data'])){
$foot=displayFoot($foot);
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>fantacalcio</title>
        <link rel="stylesheet" href="static/css/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    </head>
    <body>
        <div class="row">
            <div class=" text-center form-container box-selectedFoot rounded col-6 offset-3">
            <h1>giocatori selezionati:</h1>
                <p id="p-selectedFoot" class="text-center"></p>
            </div>
        </div>
        <div class="row">
            <div class="footList">
                <div class="row">
                    <div class="col-2 " ><button class="rounded col-2 offset-10" onclick="hideShow()">></button></div>
                    <div class="form-container bordered rounded col-8 " id="div-form" style="display:block;">
                        <form class="text-center" method="post" name="form-team" action="">
                            <div class="row">
                                <h1>team-<?php if(isset($_SESSION["n-team"])){
                                    echo $ArchiveTeam[intval($_SESSION['n-team'])]->name;}?></h1>
                                <input type="submit" class="submit rounded col-2 offset-5" style="background-color:#989898;" onclick="checkPlayerNumber(event)" name="create" value="crea">

                                <div class="text-center">
                                    <?php foreach($foot as $f){?>
                                        
                                    <div class="row">
                                        <div class="form-element">
                                        <input class="col-3 foot" name="foot[]" onclick="selectFoot(<?php echo $f->id; ?>,'<?php echo $f->name; ?>')" type="checkbox" value="<?php echo $f->id; ?>">
                                        <label class="text-center col-3 offset-1" for="<?php echo $f->name; ?>"><?php echo $f->name; ?></label>                              
                                        <label class="text-center col-3 " for="text"><?php echo $f->team; ?></label>                              
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        function hideShow(){
            const elem = document.getElementById('div-form');

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
            if(idSelectedFoot.includes(id)==false){

                idSelectedFoot.push(id);
                nameSelectedFoot.push(name);
            }else if(idSelectedFoot.includes(id)==true){
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
            displaySelectedFoot();
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
            var txt = "";

            for(const foot of nameSelectedFoot){
                txt+="-"+foot+"<br>";
            }
            document.getElementById('p-selectedFoot').innerHTML=txt;
        }

        //disabilitare click dop 15 selezioni
        const input = document.querySelectorAll('.foot');
        const submit = document.querySelectorAll('.submit');

        for(const inp of input){
            inp.addEventListener('click',updateDisplay );
        }

        function updateDisplay() {
        if(count()==3){
            disable_cb();
            submit[0].style.backgroundColor = '#DCDCDC';

        }else{
            console.log(submit);
            submit[0].style.backgroundColor = '#989898';
            enable_cb();
        }
        }

        function count(){
            let checkedCount = 0;
            for (const inp of input) {
                if (inp.checked) {
                checkedCount++;
                }
            }
            return checkedCount;
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

        function checkPlayerNumber(e){
            if(count()!=3){
                e.preventDefault();
            }
        }

    </script>
    </body>
</html>
