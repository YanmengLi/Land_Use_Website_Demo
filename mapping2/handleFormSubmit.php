<?php
date_default_timezone_set('Asia/Singapore');
session_start();
include_once('common.php');

$dataPoints1 = array(
	array('x' => 10, 'y' => 10),
	array('x' => 20, 'y' => 12),
	array('x' => 30, 'y' => 8),
	array('x' => 40, 'y' => 14),
	array('x' => 50, 'y' => 6),
	array('x' => 60, 'y' => 24),
	array('x' => 70, 'y' => -3),
	array('x' => 80, 'y' => 15)
);

$dataPoints2 = array(
    array('x' => -1524, 'y' => 120.5),
    array('x' => -1372, 'y' => 118.5),     
    array('x' => -1219, 'y' => 116.5),     
    array('x' => -1067, 'y' => 114.6),     
    array('x' => -914, 'y' => 112.7),     
    array('x' => -762, 'y' => 110.7),     
    array('x' => -610, 'y' => 108.8),     
    array('x' => -457, 'y' => 106.9),     
    array('x' => -305, 'y' => 105),     
    array('x' => -152, 'y' => 103.1),     
    array('x' => 0, 'y' => 101.3),     
    array('x' => 152, 'y' => 99.49),    
    array('x' => 305, 'y' => 97.63),   
    array('x' => 457, 'y' => 95.91),     
    array('x' => 610, 'y' => 94.19),     
    array('x' => 762, 'y' => 92.46),     
    array('x' => 914, 'y' => 90.81),     
    array('x' => 1067, 'y' => 89.15),     
    array('x' => 1219, 'y' => 87.49),     
    array('x' => 1372, 'y' => 85.91),     
    array('x' => 1524, 'y' => 84.33),     
    array('x' => 1829, 'y' => 81.22),     
    array('x' => 2134, 'y' => 78.19),     
    array('x' => 2438, 'y' => 75.22),     
    array('x' => 2743, 'y' => 27.40),     
    array('x' => 3048, 'y' => 69.64),    
    array('x' => 4572, 'y' => 57.16),    
    array('x' => 6096, 'y' => 46.61),    
    array('x' => 7620, 'y' => 37.65),    
    array('x' => 9144, 'y' => 30.13),   
    array('x' => 10668, 'y' => 23.93),    
    array('x' => 12192, 'y' => 18.82),    
    array('x' => 13716, 'y' => 24.82),
    array('x' => 15240, 'y' => 11.65),     
    array('x' => 16764, 'y' => 9.172),     
    array('x' => 18288, 'y' => 7.24),    
    array('x' => 21336, 'y' => 4.49),     
    array('x' => 24384, 'y' => 2.8),   
    array('x' => 27432, 'y' => 1.76),
    array('x' => 30480, 'y' => 1.22)
);

$res = array('status' => 'fail', 'message' => 'Please enter weight 1-3');
if (isset($_POST['weight1']) && !empty($_POST['weight1']) && isset($_POST['weight2']) && !empty($_POST['weight2']) && isset($_POST['weight3']) && !empty($_POST['weight3'])) {
	$weight_of_object1 = $_POST['weight1'];
	$weight_of_object2 = $_POST['weight2'];
	$weight_of_object3 = $_POST['weight3'];

    // Include the CSV parser which will give us all the data for the chart & map
    //include_once('parser.php');
    $csvdata = get_csv_data($weight_of_object1, $weight_of_object2, $weight_of_object3);
    
    // prepare the rank array
    $temp = $csvdata['rank'];
    asort($temp, SORT_NUMERIC); // first sort the array on the solution (lowest first)
    $rank = array();
    foreach ($temp as $solutionid => $solution) { // arrange the solution rank wise
        $rank[] = array('solutionid' => $solutionid, 'solution' => $solution, 'obj1' => $csvdata['rank2'][$solutionid]['obj1'] , 'obj2' => $csvdata['rank2'][$solutionid]['obj2'] , 'obj3' => $csvdata['rank2'][$solutionid]['obj3']);
    }

    // prepare the data for chart2
    $dataPoints2 = array();
    foreach ($csvdata['rank'] as $x => $y) {
        $dataPoints2[] = array('x' => $x, 'y' => $y);
    }
    

    $res['status'] 	= 'success';
    $res['message'] = 'Form Submission Succesful';
    $res['data'] 	= array('chart1' => $dataPoints1, 'chart2' => $dataPoints2, 'bestSol' => $csvdata['bestSol'], 'rank' => $rank);
}
echo json_encode($res);
?>