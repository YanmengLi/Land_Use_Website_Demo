<?php
session_start();

$dataPoints1 = [
	['x' => 10, 'y' => 10],
	['x' => 20, 'y' => 12],
	['x' => 30, 'y' => 8],
	['x' => 40, 'y' => 14],
	['x' => 50, 'y' => 6],
	['x' => 60, 'y' => 24],
	['x' => 70, 'y' => -3],
	['x' => 80, 'y' => 15]
];

$dataPoints2 = [
    ['x' => -1524, 'y' => 120.5],
    ['x' => -1372, 'y' => 118.5],     
    ['x' => -1219, 'y' => 116.5],     
    ['x' => -1067, 'y' => 114.6],     
    ['x' => -914, 'y' => 112.7],     
    ['x' => -762, 'y' => 110.7],     
    ['x' => -610, 'y' => 108.8],     
    ['x' => -457, 'y' => 106.9],     
    ['x' => -305, 'y' => 105],     
    ['x' => -152, 'y' => 103.1],     
    ['x' => 0, 'y' => 101.3],     
    ['x' => 152, 'y' => 99.49],    
    ['x' => 305, 'y' => 97.63],   
    ['x' => 457, 'y' => 95.91],     
    ['x' => 610, 'y' => 94.19],     
    ['x' => 762, 'y' => 92.46],     
    ['x' => 914, 'y' => 90.81],     
    ['x' => 1067, 'y' => 89.15],     
    ['x' => 1219, 'y' => 87.49],     
    ['x' => 1372, 'y' => 85.91],     
    ['x' => 1524, 'y' => 84.33],     
    ['x' => 1829, 'y' => 81.22],     
    ['x' => 2134, 'y' => 78.19],     
    ['x' => 2438, 'y' => 75.22],     
    ['x' => 2743, 'y' => 27.40],     
    ['x' => 3048, 'y' => 69.64],     
    ['x' => 4572, 'y' => 57.16],     
    ['x' => 6096, 'y' => 46.61],     
    ['x' => 7620, 'y' => 37.65],     
    ['x' => 9144, 'y' => 30.13],     
    ['x' => 10668, 'y' => 23.93],     
    ['x' => 12192, 'y' => 18.82],     
    ['x' => 13716, 'y' => 24.82],     
    ['x' => 15240, 'y' => 11.65],     
    ['x' => 16764, 'y' => 9.172],     
    ['x' => 18288, 'y' => 7.24],    
    ['x' => 21336, 'y' => 4.49],     
    ['x' => 24384, 'y' => 2.8],     
    ['x' => 27432, 'y' => 1.76],     
    ['x' => 30480, 'y' => 1.22]    

];

$res = array('status' => 'fail', 'message' => 'Please enter weight 1-3');
if(isset($_POST['weight1']) && !empty($_POST['weight1']) && isset($_POST['weight2']) && !empty($_POST['weight2']) && isset($_POST['weight3']) && !empty($_POST['weight3'])) {
	$weight1 = $_POST['weight1'];
	$weight2 = $_POST['weight2'];
	$weight3 = $_POST['weight3'];
$_SESSION['wt1']=$weight1;
$_SESSION['wt2']=$weight2;
$_SESSION['wt3']=$weight3;
    $res['status'] 	= 'success';
    $res['message'] = 'Form Submission Succesful';
    $res['data'] 	= array('chart1' => $dataPoints1, 'chart2' => $dataPoints2, 'map' => '');
}
echo json_encode($res);
?>