<?php
function get_csv_data($weight_of_object1=0, $weight_of_object2=0, $weight_of_object3=0,$solution_id=-1) {
    $db_csv = 'ParetoSolutions.csv';
    $lines  = file($db_csv);
    
    // default values
    // if (!isset($weight_of_object1) || !isset($weight_of_object2) || !isset($weight_of_object3)) {
    //     $weight_of_object1 = 0.5;
    //     $weight_of_object2 = 0.7;
    //     $weight_of_object3 = 0.8;
    // }

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
    $bestRank   = 99999999;
    $bestSol    = 0;
    $rank2      = array();
    for ($sol=1; $sol<=30; $sol++) {
        $rank[$sol]  = ($ttime[$sol] * $weight_of_object1) + ($bs[$sol] * $weight_of_object2) + ($pop[$sol] * $weight_of_object3);
        $rank2[$sol] = array('sol' => $rank[$sol], 'obj1' => ($ttime[$sol] * $weight_of_object1), 'obj2' => ($bs[$sol] * $weight_of_object2), 'obj3' => ($pop[$sol] * $weight_of_object3));
        if ($bestRank > $rank[$sol]) {
            $bestRank = $rank[$sol];    
            $bestSol  = $sol;
        }
    }

    // Manual display of solutions
    if($solution_id!=-1){
            $bestSol=$solution_id;
            $rank=1; //irrelevant
    }

    $a = "weight_of_object1 = $weight_of_object1\n";
    $a.= "weight_of_object2 = $weight_of_object2\n";
    $a.= "weight_of_object3 = $weight_of_object3\n";
    $a.= "Best solution: $bestRank SolID: $bestSol\n";
    $a.= "Arcs to be highlighted\n";
    file_put_contents("parserlog.txt", $a . print_r($arcColor[$bestSol],true));

    return array('bestSol' => $bestSol, 'arcColor' => $arcColor, 'bestSolArcs' => $arcColor[$bestSol], 'rank' => $rank, 'rank2' => $rank2);

}