<?php 
include_once dirname(__FILE__) . '/getArchiveTeam.php';
include_once dirname(__FILE__) . '/getArchiveDay.php';
include_once dirname(__FILE__) . '/getArchiveGame.php';
include_once dirname(__FILE__) . '/setDay.php';
include_once dirname(__FILE__) . '/setGame.php';
//controlla se sono già settate delle gironate
function generateGame(){
	$archiveGame=getArchiveGame();
	if(empty($archiveGame)){
		exit("dati già inseriti");
		header('Location: index.php');
	}

	//get delle squadre e salvataggio degli id
	$p=array();
	$archiveTeam=getArchiveTeam();
	foreach($archiveTeam as $team){
		array_push($p,$team->id);
	}
	$data=array();

	//creazione day e salvatggio id day
	$nday=(count($p)-1)*2;
	for($i=0;$i<$nday;$i++){
		//setDay(NULL,NULL);
	}
	$days=array();
	$archiveDay=getArchiveDay();
	foreach($archiveDay as $gameDay){
		array_push($days,$gameDay->id);
	}

	$b=AlgoritmoDiBerger($p,'r');
	$e=AlgoritmoDiBerger($p,'a');



	$id_team1=0;
	$id_team2=0;
	$day=0;
	foreach($b as $c){
		$day++;
		$swipe=0;
		foreach($c as $d){
			foreach($d as $f){
				if($swipe==0){
					$id_team1=intval($d[0]);
					$swipe=$swipe+1;
				}else if($swipe==1){
					$id_team2=intval($d[1]);
					$swipe--;
				}
			}
			$indexDay=$day-1;
			$tmp=array(
				"id_gameDay"=>$days[$indexDay],
				"id_team1"=>$id_team1,
				"id_team2"=>$id_team2,
			);
			array_push($data,$tmp);
		}
	}
	foreach($e as $c){
		$day++;
		$swipe=0;
		foreach($c as $d){
			foreach($d as $f){
				if($swipe==0){
					$id_team1=intval($d[0]);
					$swipe=$swipe+1;
				}else if($swipe==1){
					$id_team2=intval($d[1]);
					$swipe--;
				}
			}
			$indexDay=$day-1;
			$tmp=array(
				"id_gameDay"=>$days[$indexDay],
				"id_team1"=>$id_team1,
				"id_team2"=>$id_team2,
			);
			array_push($data,$tmp);
		}

	}

	foreach($data as $dataSingleRow){
		setGame($dataSingleRow);
	}
}
function AlgoritmoDiBerger( $arrSquadre, $andata_ritorno ) {

	$numero_squadre = count( $arrSquadre );
	if ( $numero_squadre % 2 == 1 ) {
		$arrSquadre[] = "BYE";   // numero giocatori dispari? aggiungere un riposo (BYE)!
		$numero_squadre ++;
	}
	$giornate = $numero_squadre - 1;
	/* crea gli array per le due liste in casa e fuori */
	for ( $i = 0; $i < $numero_squadre / 2; $i ++ ) {
		$casa[ $i ]      = $arrSquadre[ $i ];
		$trasferta[ $i ] = $arrSquadre[ $numero_squadre - 1 - $i ];

	}

	for ( $i = 0; $i < $giornate; $i ++ ) {

		/* alterna le partite in casa e fuori */
		if ($andata_ritorno == 'a') {
			if ( ( $i % 2 ) == 0 ) {
				for ( $j = 0; $j < $numero_squadre / 2; $j ++ ) {

					$c = $trasferta[ $j ];
					$o = $casa[ $j ];

					$abbinamenti[ $i ][] = array( $c, $o );
				}
			} else {
				for ( $j = 0; $j < $numero_squadre / 2; $j ++ ) {

					$o = $trasferta[ $j ];
					$c = $casa[ $j ];

					$abbinamenti[ $i ][] = array( $c, $o );
				}

			}
		} else {

			if ( ( $i % 2 ) == 0 ) {
				for ( $j = 0; $j < $numero_squadre / 2; $j ++ ) {

					$o = $trasferta[ $j ];
					$c = $casa[ $j ];

					$abbinamenti[ $i ][] = array( $c, $o );
				}
			} else {
				for ( $j = 0; $j < $numero_squadre / 2; $j ++ ) {

					$c = $trasferta[ $j ];
					$o = $casa[ $j ];

					$abbinamenti[ $i ][] = array( $c, $o );
				}

			}
		}

		// Ruota in gli elementi delle liste, tenendo fisso il primo elemento
		// Salva l'elemento fisso
		$pivot = $casa[0];

		/* sposta in avanti gli elementi di "trasferta" inserendo
		   all'inizio l'elemento casa[1] e salva l'elemento uscente in "riporto" */
		array_unshift( $trasferta, $casa[1] );
		$riporto = array_pop( $trasferta );

		/* sposta a sinistra gli elementi di "casa" inserendo all'ultimo
		   posto l'elemento "riporto" */
		array_shift( $casa );
		array_push( $casa, $riporto );

		// ripristina l'elemento fisso
		$casa[0] = $pivot;
	}

	return $abbinamenti;
}
?>