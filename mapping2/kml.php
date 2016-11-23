<?php
date_default_timezone_set('Asia/Singapore');
session_start();
include("common.php");

// stripped <styleUrl>#LineStyle00</styleUrl> from all arcs
// added green <styleUrl>#LineStyle01</styleUrl> at the end

// filter data
// if, we do not have a solution in the session then, include parser.php here to get the default solution
$isempty        = false;
$showonlygreen  = true;


if( (isset($_GET['solution_id']) && !empty($_GET['solution_id']) && $_GET['solution_id']>0)
//     &&
//     (!isset($_GET['w1']) || empty($_GET['w1']) || !isset($_GET['w2']) || empty($_GET['w2']) || !isset($_GET['w3']) || empty($_GET['w3']))
// &&
//   (isset($_GET['w1']) && $_GET['w1']!=-1)


    ) {
    $weight_of_object1 = 1;
    $weight_of_object2 = 1;
    $weight_of_object3 = 1;
    $csvdata = get_csv_data($weight_of_object1, $weight_of_object2, $weight_of_object3,$_GET['solution_id']);

    if (isset($_GET['showallpaths']) && $_GET['showallpaths'] == 1) {
        $showonlygreen = false;
    }
}else if(isset($_GET['w1']) && !empty($_GET['w1']) && isset($_GET['w2']) && !empty($_GET['w2']) && isset($_GET['w3']) && !empty($_GET['w3'])) {
    $weight_of_object1 = $_GET['w1'];
    $weight_of_object2 = $_GET['w2'];
    $weight_of_object3 = $_GET['w3'];
    $csvdata = get_csv_data($weight_of_object1, $weight_of_object2, $weight_of_object3,-1);

    if (isset($_GET['showallpaths']) && $_GET['showallpaths'] == 1) {
        $showonlygreen = false;
    }

} else {
    $isempty = true;
    @file_put_contents('session-log.txt', date('Y-m-d H:i:s') . '---BLANK');

}

header("Content-Type: application/vnd.google-earth.kml+xml");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Sat, 01 Jan 2000 00:00:00 GMT");
//header("Content-Length: 1550000");//253721

if ($isempty == true) {
    echo file_get_contents('blank.kml');
    exit;
}
@file_put_contents('session-log.txt', date('Y-m-d H:i:s') . "\nCSV Array: \n" . print_r($csvdata, 1));

$fh = fopen("kml-log.txt", 'w');
$place_mark_started = false;
$handle = @fopen("doc.kml", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
    	if(strstr($buffer, '<Placemark id=')){
    		$place_mark_started=true;
    		$buf=$buffer;
    		// <Placemark id="ID_00739">
    		$id   = str_replace('<Placemark id="ID_', '', $buffer);
    		$a    = str_replace('">', '', $id);
    		$id   = $id+1; //offset
    		//if(isset($arcColor[$bestSol][$id])&&$arcColor[$bestSol][$id]==1){
            //if(isset($arcColor[$bestSol][$id])){
    		if (isset($csvdata['bestSolArcs'][$id])) {
    			$buf.='<styleUrl>#LineStyle01</styleUrl>'."\n";
                fwrite($fh, $id." green\n");

    		} else {
    			$buf.='<styleUrl>#LineStyle00</styleUrl>'."\n";
                fwrite($fh, $id." red\n");

    		}
    		continue;

    	}

    	if ($place_mark_started) {
    		if (strstr($buffer, '</Placemark>')) {
	    		$place_mark_started = false;

                if ($showonlygreen == false) {
                    echo $buf.$buffer; // show both colors     

                } else {
                    if (isset($csvdata['bestSolArcs'][$id])) echo $buf.$buffer;// only show green    
                    
                }

                //if(isset($arcColor[$bestSol][$id]))echo $buf.$buffer;// only show green
                //if (isset($csvdata['bestSolArcs'][$id])) echo $buf.$buffer;// only show green
                //echo $buf.$buffer; // show both colors 
                $buf = '';

    		} else {
    			$buf.=$buffer;

    		}

   		} else {
   			echo $buffer;

   		}

    }
	if (!feof($handle)) {
 	   echo "Error: unexpected fgets() fail\n";
	}

    fclose($handle);

}
fclose($fh);
