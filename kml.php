<?php
session_start();
// stripped <styleUrl>#LineStyle00</styleUrl> from all arcs
// added green <styleUrl>#LineStyle01</styleUrl> at the end

header("Content-Type: application/vnd.google-earth.kml+xml");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Sat, 01 Jan 2000 00:00:00 GMT");
//header("Content-Length: 1550000");//253721


// filter data
include("mapping/parser.php");



$place_mark_started=false;
$handle = @fopen("doc.kml", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
    	if(strstr($buffer, '<Placemark id=')){
    		$place_mark_started=true;
    		$buf=$buffer;
    		// <Placemark id="ID_00739">
    		$id=str_replace('<Placemark id="ID_', '', $buffer);
    		$a=str_replace('">', '', $id);
    		//if($id>50&&$id<60){
    		$id=$id*1;
    		//if(isset($arcColor[$bestSol][$id])&&$arcColor[$bestSol][$id]==1){
    		if(isset($arcColor[$bestSol][$id])){
    			$buf.='<styleUrl>#LineStyle01</styleUrl>'."\n";
    		}else{
    			$buf.='<styleUrl>#LineStyle00</styleUrl>'."\n";
    		}
    		continue;
    	}
    	if($place_mark_started){
    		if(strstr($buffer, '</Placemark>')){
	    		$place_mark_started=false;
	    		//if($id<700)
	    			if(isset($arcColor[$bestSol][$id]))echo $buf.$buffer;// only show green
	    			// echo $buf.$buffer; // show both colors 
    		}else{
    			$buf.=$buffer;
    		}
   		}else{
   			echo $buffer;
   		}
    }
	if (!feof($handle)) {
 	   echo "Error: unexpected fgets() fail\n";
	}
    fclose($handle);
}