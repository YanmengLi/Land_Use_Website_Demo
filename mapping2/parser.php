<?php
date_default_timezone_set('Asia/Singapore');
//session_start();

$db_csv = 'ParetoSolutions.csv';
$lines  = file($db_csv);
//print_r($lines);exit;

// $weight_of_object1 = 0.1;
// $weight_of_object2 = 0.7;
// $weight_of_object3 = 0.8;

// $weight_of_object1 = $_SESSION['wt1'];
// $weight_of_object2 = $_SESSION['wt2'];
// $weight_of_object3 = $_SESSION['wt3'];

// These 3 variables will be defined in handleFormSubmit.php
// This file is included in handleFormSubmit.php and hence, you will get it.
if (!isset($weight_of_object1) || !isset($weight_of_object2) || !isset($weight_of_object3)) {
	$weight_of_object1 = 0.5;
	$weight_of_object2 = 0.7;
	$weight_of_object3 = 0.8;
}

// Collect the values
foreach ($lines as $line) {
	$line  = chop($line);
	$cells = explode(',', $line);
	if($cells[0]=='myID') continue; // Skip the first row - headers
	if($cells[0]=='ttime'){
		for ($sol=1;$sol<=30;$sol++) {
			$ttime[$sol] = $cells[$sol];
		}
		continue;

	} 

	if ($cells[0] == 'bs') {
		for ($sol=1;$sol<=30;$sol++) {
			$bs[$sol] = $cells[$sol];
		}
		continue;

	}

	if ($cells[0] == 'pop') {
		for ($sol=1;$sol<=30;$sol++) {
			$pop[$sol] = $cells[$sol];
		}
		continue;

	}

	// These are the arc shade rows
	// Collect the arc shades
	$arcID = $cells[0];

	for ($sol=1; $sol<=30; $sol++) {
		//$arcColor[$sol][$arcID] = $cells[$sol]; // 1 or 0
		if ($cells[$sol] == 1) $arcColor[$sol][$arcID] = $cells[$sol]; // 1 or 0

	}

}

// Calculate the solutions
$bestRank = 99999999;
$bestSol  = 0;
for ($sol=1; $sol<=30; $sol++) {
	$rank[$sol] = ($ttime[$sol] * $weight_of_object1) + ($bs[$sol] * $weight_of_object2) + ($pop[$sol] * $weight_of_object3);
	if ($bestRank > $rank[$sol]) {
		$bestRank = $rank[$sol];	
		$bestSol  = $sol;
	}
}

//print_r($ttime);
//print_r($bs);
//print_r($pop);
//print_r($arcColor[1]);
//print_r($rank);
// echo "weight_of_object1 = $weight_of_object1\n" ;
// echo "weight_of_object2 = $weight_of_object2\n" ;
// echo "weight_of_object3 = $weight_of_object3\n" ;
// echo "Best solution: $bestRank SolID: $bestSol\n";
// echo "Arcs to be highlighted\n";
// print_r($arcColor[$bestSol]);

unset($_SESSION['csvdata']);
$_SESSION['csvdata'] = array('bestSol' => $bestSol, 'arcColor' => $arcColor, 'bestSolArcs' => $arcColor[$bestSol], 'rank' => $rank);
@file_put_contents('session-log2.txt', date('Y-m-d H:i:s') . print_r($_SESSION, 1));

$a = "weight_of_object1 = $weight_of_object1\n";
$a.= "weight_of_object2 = $weight_of_object2\n";
$a.= "weight_of_object3 = $weight_of_object3\n";
$a.= "Best solution: $bestRank SolID: $bestSol\n";
$a.= "Arcs to be highlighted\n";
file_put_contents("parserlog.txt", $a . print_r($arcColor[$bestSol],true));
