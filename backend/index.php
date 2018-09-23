<?php
	//
	// Eerst alle data laden die we hebben gekregen van de gebruiker
	//
	
	// De datum: ...
	$jaar 	= $_GET["y"];
	$maand 	= $_GET["m"];
	$dag 	= $_GET["d"];
	
	// De browser vertellen dat we JSON sturen
	header('Content-Type: application/json');
	
	// Eerste JSON tag geven
	echo "{";
	// Data terugsturen die is meeverzonden
	echo "\"Referentie\":{" . verwerkDatum($jaar,$maand,$dag) . "},";
	
	// We beginnen met het berekenen van Pascha van dat gegeven jaar.
	// Dit heb ik gevonden op de volgende website: https://manios.org/2012/08/14/java-calculate-orthodox-easter-date
	$Pascha_jaar = $jaar;
	$a_r1 = $jaar % 4;
	$a_r2 = $jaar % 7;
	$a_r3 = $jaar % 19;
	$a_r4 = (19 * $a_r3 + 15) % 30;
	$a_r5 = (2 * $a_r1 + 4 * $a_r2 + 6 * $a_r4 + 6) % 7;
	$a_r6 = $a_r5 + $a_r4 + 13;
	if($a_r6 > 39 ){
		$Pascha_maand = 5;
		$Pascha_dag = $a_r6 - 39;
	}else if($a_r6 > 9 ){
		$Pascha_maand = 4;
		$Pascha_dag = $a_r6 - 9;
	}else{
		$Pascha_maand = 3;
		$Pascha_dag = $a_r6 + 22;
	}
	// Rapporteren
	echo "\"Hoogfeesten\":{\"Pascha\":{" . verwerkDatum($Pascha_jaar,$Pascha_maand,$Pascha_dag) . "}}";
	
	// Einde van programma, JSON tag afsluiten
	echo "}";
	
	function verwerkDatum($J,$M,$D){
		return "\"Datum\":{
			\"jaar\":$J,
			\"maand\":$M,
			\"dag\":$D
		}";
	}
?>
