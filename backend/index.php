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
	// Beweegbare feesten uitrekenen (deze zitten ten opzichte van Pasen)
	
	// Pascha
	$Pascha = strtotime("$jaar-$maand-$dag");
	// Palmzondag
	$Palmzondag = strtotime("$jaar-$maand-$dag - 7 days");
	// Hemelvaart
	$Hemelvaart = strtotime("$jaar-$maand-$dag + 40 days");
	// Pinksteren
	$Pinksteren = strtotime("$jaar-$maand-$dag + 50 days");
	
	//
	// Vaste feesten uitrekenen (deze hebben altijd dezelfde datum)
	//
	
	// Geboorte van Moeder Gods
	$GeboorteMoederGods 	= strtotime("$jaar-9-21");
	// Tempelgang
	$Tempelgang		= strtotime("$jaar-12-4");
	// Verkondiging
	$Verkondiging		= strtotime("$jaar-4-7");
	// Geboorte
	$Geboorte		= strtotime("$jaar-1-7");
	// Ontmoeting
	$Ontmoeting		= strtotime("$jaar-2-15");
	// Theofanie
	$Theofanie		= strtotime("$jaar-1-19");
	// Transfiguratie
	$Transfiguratie		= strtotime("$jaar-8-19");
	// Ontslapen
	$Ontslapen		= strtotime("$jaar-8-28");
	// Kruisverheffing
	$kruisverheffing	= strtotime("$jaar-9-27");
	
	// Rapporteren
	echo "\"Hoogfeesten\":{
		\"Pascha\":{" 			. verwerkDatum($Pascha_jaar,$Pascha_maand,$Pascha_dag) 	. "},
		\"Palmzondag\":{" 		. verwerkDatum2($Palmzondag) 				. "},
		\"Hemelvaart\":{" 		. verwerkDatum2($Hemelvaart) 				. "},
		\"Pinksteren\":{" 		. verwerkDatum2($Pinksteren) 				. "},
		\"Geboortemoedergods\":{" 	. verwerkDatum2($GeboorteMoederGods) 			. "},
		\"Tempelgang\":{" 		. verwerkDatum2($Tempelgang) 				. "},
		\"Verkondiging\":{" 		. verwerkDatum2($Verkondiging) 				. "},
		\"Geboorte\":{" 		. verwerkDatum2($Geboorte) 				. "},
		\"Ontmoeting\":{" 		. verwerkDatum2($Ontmoeting) 				. "},
		\"Theofanie\":{" 		. verwerkDatum2($Theofanie) 				. "},
		\"Transfiguratie\":{" 		. verwerkDatum2($Transfiguratie) 			. "},
		\"Ontslapen\":{" 		. verwerkDatum2($Ontslapen) 				. "},
		\"Kruisverheffing\":{" 		. verwerkDatum2($Kruisverheffing) 			. "}
	}";
	
	// Einde van programma, JSON tag afsluiten
	echo "}";
	
	function verwerkDatum2($datum){
		return verwerkDatum(date("Y",$datum),date("m",$datum),date("d",$datum));
	}
	
	function verwerkDatum($J,$M,$D){
		return "\"Datum\":{
			\"jaar\":$J,
			\"maand\":$M,
			\"dag\":$D
		}";
	}
?>
