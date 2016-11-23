<?php
date_default_timezone_set('Asia/Singapore');
session_start();
/*//include 'parser.php';
include('mapping2/common.php');
$arr = get_csv_data(0.1, 0.7, 0.8);
print_r($arr);
var_dump($arr);
exit;*/
$ttime = array
        (
            1 => 44.05,
            2 => 44.11,
            3 => 45.28,
            4 => 46.62,
            5 => 43.09,
            6 => 43.77,
            7 => 43.83,
            8 => 41.08,
            9 => 42.16,
            10 => 42.62,
            11 => 43.96,
            12 => 45.81,
            13 => 45.96,
            14 => 47.81,
            15 => 42.78,
            16 => 44.12,
            17 => 45.5,
            18 => 54.58,
            19 => 38.3,
            20 => 39.64,
            21 => 48.57,
            22 => 49.91,
            23 => 48.26,
            24 => 49.6,
            25 => 37.1,
            26 => 43.1,
            27 => 47,
            28 => 42.14,
            29 => 36.46,
            30 => 56.99,
        );

$bs = array
        (
            1 => 0,
            2 => 0,
            3 => 1,
            4 => 1,
            5 => 2,
            6 => 2,
            7 => 2,
            8 => 3,
            9 => 3,
            10 => 3,
            11 => 3,
            12 => 3,
            13 => 3,
            14 => 3,
            15 => 4,
            16 => 4,
            17 => 4,
            18 => 4,
            19 => 5,
            20 => 5,
            21 => 5,
            22 => 5,
            23 => 6,
            24 => 6,
            25 => 7,
            26 => 7,
            27 => 7,
            28 => 8,
            29 => 11,
            30 => 11,
        );

$pop = array
        (
            1 => 15.748,
            2 => 14.588,
            3 => 13.321,
            4 => 13.098,
            5 => 16.119,
            6 => 15.754,
            7 => 14.594,
            8 => 14.246,
            9 => 13.35,
            10 => 13.271,
            11 => 13.048,
            12 => 12.965,
            13 => 12.825,
            14 => 12.742,
            15 => 13.248,
            16 => 13.025,
            17 => 12.983,
            18 => 13.432,
            19 => 12.663,
            20 => 12.44,
            21 => 12.218,
            22 => 11.995,
            23 => 11.822,
            24 => 11.599,
            25 => 12.894,
            26 => 12.186,
            27 => 12.092,
            28 => 12.231,
            29 => 16.818,
            30 => 10.866,
        );

?>

<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Land Use Allocation</title>

	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
	<link href="assets/css/simple-line-icons.css" rel="stylesheet" media="screen">
	<link href="assets/css/animate.css" rel="stylesheet">
    
	<script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>					  
	<script type="text/javascript" src="assets/js/jquery.canvasjs.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js" ></script>
	
	<!-- chart demo1 -->
	<script type="text/javascript">
	function sample ($scope) {
			
    }
	// The charts
	var chart1;
	var chart2;
	var chart3;
	var chart4;
  	window.onload = function () {
		chart1 = new CanvasJS.Chart("chartContainer1", {
			backgroundColor: "#F5F5F5",
			 axisX:{ 
			   title: "bs",
			 },
			 
			 axisY:{ 
			   title: "ttime",
			 },
			title: {
				text: "Chart 1"
			},
            	animationEnabled: true,
			data: [{
				type: "scatter",
		        markerType: "circle",
		        marketSize: 20,
		        markerColor : "rgba(54,158,173,.9)",
		        toolTipContent: "<span style='\"'color: {color};'\"'><strong>bs</strong></span> {x}<br/><span style='\"'color: {color};'\"'><strong>ttime</strong></span> {y}",
		        // markerBorderColor : "rgba(54,158,173,.9)",
		        // markerBorderThickness: 5,
				dataPoints: [
					<?php
						for ($i=0; $i < 30 ; $i++) { 
                                    echo '{x: ' . $bs[$i+1]. ', y: ' . $ttime[$i+1] . '},' . "\n";
                              }
                    ?>
				]
			}]
		});
		chart1.render();

		chart3 = new CanvasJS.Chart("chartContainer2", {
			backgroundColor: "#F5F5F5",
			
			axisX:{ 
			   title: "bs",
			 },
			 
			 axisY:{ 
			   title: "pop",
			 },
			title: {
				text: "Chart 2"
			},
            animationEnabled: true,
			data: [{
				type: "scatter",
		        markerType: "circle",
		        marketSize: 20,
		        markerColor : "rgba(54,158,173,.9)",
		        toolTipContent: "<span style='\"'color: {color};'\"'><strong>bs</strong></span> {x}<br/><span style='\"'color: {color};'\"'><strong>pop</strong></span> {y}",
		        // markerBorderColor : "rgba(54,158,173,.9)",
		        // markerBorderThickness: 5,
				dataPoints: [
					<?php
						for ($i=0; $i < 30 ; $i++) { 
                                    echo '{x: ' . $bs[$i+1]. ', y: ' . $pop[$i+1] . '},' . "\n";
                              }
                    ?>
				]
			}]
		});
		chart3.render();

		chart4 = new CanvasJS.Chart("chartContainer3", {
			backgroundColor: "#F5F5F5",
			axisX:{ 
			   title: "pop",
			 },
			 
			 axisY:{ 
			   title: "ttime",
			 },
			title: {
				text: "Chart 3"
			},
            animationEnabled: true,
			data: [{
		        type: "scatter",
		        markerType: "circle",
		        marketSize: 20,
		        markerColor : "rgba(54,158,173,.9)",
		        toolTipContent: "<span style='\"'color: {color};'\"'><strong>pop</strong></span> {x}<br/><span style='\"'color: {color};'\"'><strong>ttime</strong></span> {y}",
		        // markerBorderColor : "rgba(54,158,173,.9)",
		        // markerBorderThickness: 5,
				dataPoints: [
					<?php
						for ($i=0; $i < 30 ; $i++) { 
                                    echo '{x: ' . $pop[$i+1]. ', y: ' . $ttime[$i+1] . '},' . "\n";
                              }
                    ?>
				]
			}]
		});
		chart4.render();

		chart2 = new CanvasJS.Chart("chartContainer4", {
			backgroundColor: "#F5F5F5",
			title: {
	        	text: "Best Solution"
	      	},     
	      	axisY: {
	        	title: "Solution",
	        	suffix: "" //" kPa"
	      	},
	      	axisX: {
	        	title: "Solution Number",
	        	suffix: "" //" m"
	      	},
	      	animationEnabled: true,
			data: [{      
		        markerSize: 6, 
		        toolTipContent: "<span style='\"'color: {color};'\"'><strong>Solution Number</strong></span> {x}<br/><span style='\"'color: {color};'\"'><strong>Solution</strong></span> {y}",
		        type: "spline",
		        showInLegend: true,
		        legendText: "Legend: Lowest solution is the best",
		        dataPoints: [
			        {x: -1524 , y: 120.5},     
			        {x: -1372 , y: 118.5},     
			        {x: -1219, y: 116.5},     
			        {x: -1067, y: 114.6},     
			        {x: -914, y: 112.7},     
			        {x: -762 , y: 110.7},     
			        {x: -610 , y: 108.8},     
			        {x: -457 , y: 106.9},     
			        {x: -305 , y: 105},     
			        {x: -152 , y: 103.1},     
			        {x: 0 , y: 101.3},     
			        {x: 152 , y: 99.49},    
			        {x: 305 , y: 97.63},   
			        {x: 457 , y: 95.91},     
			        {x: 610 , y: 94.19},     
			        {x: 762 , y: 92.46},     
			        {x: 914 , y: 90.81},     
			        {x: 1067 , y: 89.15},     
			        {x: 1219 , y: 87.49},     
			        {x: 1372 , y: 85.91},     
			        {x: 1524 , y: 84.33},     
			        {x: 1829 , y: 81.22},     
			        {x: 2134 , y: 78.19},     
			        {x: 2438 , y: 75.22},     
			        {x: 2743 , y: 72.40},     
			        {x: 3048 , y: 69.64},     
			        {x: 4572 , y: 57.16},     
			        {x: 6096 , y: 46.61},     
			        {x: 7620 , y: 37.65},     
			        {x: 9144 , y: 30.13},     
			        {x: 10668 , y: 23.93},     
			        {x: 12192 , y: 18.82},     
			        {x: 13716 , y: 14.82},     
			        {x: 15240 , y: 11.65},     
			        {x: 16764 , y: 9.172},     
			        {x: 18288 , y: 7.24},    
			        {x: 21336 , y: 4.49},     
			        {x: 24384 , y: 2.8},     
			        {x: 27432, y: 1.76},     
			        {x: 30480, y: 1.12}    

				]
		    }]
		});
		chart2.render();
	}
	</script>

	<!-- Custom styles CSS -->
	<link href="assets/css/style.css" rel="stylesheet" media="screen">
	<script src="assets/js/modernizr.custom.js"></script>
    <style>
      #map-canvas {
       position: relative;
       top:0px;
       left:0px;
       width: 100%;
       height: 750px;
      }
      .cb {    
	    list-style: none;
	    padding: 20px;
	    display:inline-block;
	    background-color: #000;  
	    color: #FFF;
	    border: 1px solid black;
		border-radius: 5px;
	}
.cb:hover{
		background-color: #4a4a4a; 
		color: #FFF;
	}
    </style>
</head>
<body>

	<!-- Preloader -->
	<div id="preloader">
		<div id="status"></div>
	</div>

	<!-- Home start -->
	<section id="home" class="pfblock-image screen-height">
        <div class="home-overlay"></div>
		<div class="intro">
			<div class="start">Singapore Road Network</div>
			<h1>Interactive Routing for Waste Collection</h1>
			<div class="start">Support System</div>
		</div>

        <a href="#input">
		<div class="scroll-down">
            <span>
                <i class="fa fa-angle-down fa-2x"></i>
            </span>
		</div>
        </a>

	</section>
	<!-- Home end -->

	<!-- Navigation start -->
	<header class="header">
		<nav class="navbar navbar-custom" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">Interactive Routing</a>
				</div>
				<div class="collapse navbar-collapse" id="custom-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#home">Home</a></li>
						<li><a href="#input">Input</a></li>
                        <li><a href="#map">Map</a></li>
                        <li><a href="#chart">Chart</a></li>
					</ul>
				</div>
			</div><!-- .container -->
		</nav>
	</header>
	<!-- Navigation end -->

    <!-- Input start -->
	<section id="input" class="pfblock pfblock-gray">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="pfblock-header">
						<h2 class="pfblock-title">Please enter parameter values</h2>
						<div class="pfblock-line"></div>		
					</div>
				</div>
			</div><!-- .row -->
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<form id="contact-form" role="form">
						<div class="ajax-hidden">
							<div class="form-group wow fadeInUp" data-wow-delay=".1s">
								<label class="sr-only" for="weight1">Weight of OBJ1</label>
								<input type="text" id="weight1" class="form-control" name="weight1" placeholder="Weight-Obj1 (Traffic Time)">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".2s">
								<label class="sr-only" for="weight2">Weight of OBJ2</label>
								<input type="text" id="weight2" class="form-control" name="weight2" placeholder="Weight-Obj2 (Black Spots or Accident Risk)">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".3s">
								<label class="sr-only" for="weight3">Weight of OBJ3</label>
								<input type="text" id="weight3" class="form-control" name="weight3" placeholder="Weight-Obj3 (Population Exposure)">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".4s">
								<label class="sr-only" for="alpha">α</label>
								<input type="text" id="alpha" class="form-control" name="alpha" placeholder="α">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".5s">
								<label class="sr-only" for="beta">β</label>
								<input type="text" id="beta" class="form-control" name="beta" placeholder="β">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".6s">
								<label class="sr-only" for="e">e</label>
								<input type="text" id="e" class="form-control" name="e" placeholder="e">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".7s">
								<label class="sr-only" for="a">a</label>
								<input type="text" id="a" class="form-control" name="a" placeholder="a">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".8s">
								<label class="sr-only" for="iteration">Iteration</label>
								<input type="text" id="iteration" class="form-control" name="iteration" placeholder="#iterations">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".9s">
								<label class="sr-only" for="ants">Ants</label>
								<input type="text" id="ants" class="form-control" name="ants" placeholder="#Ants">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay="1s">
								<label class="sr-only" for="p">P</label>
								<input type="text" id="p" class="form-control" name="p" placeholder="P">
							</div>

							<button type="submit" class="btn btn-lg btn-block wow fadeInUp" data-wow-delay="1.1s">Submit</button>
						</div>
						<div class="ajax-response"></div>
					</form>
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</section>
	<!-- Input end -->
    
	<!-- map start -->
	<section id="map" class="pfblock">
		<div class="container">
			<!--div id="map-canvas" style="width:150;height:150px;"></div-->
			<!--iframe src="https://www.google.com/maps/d/embed?mid=zpn-MuCurUHc.kPmUd5E7QpuU" width="100%" height="750"></iframe-->
			<!--div id="map-canvas2"></div-->
			<div id="map-canvas"></div>
		</div>
	</section>
	<!-- map end -->
    
    <!-- chart start -->
    <section class="pfblock pfblock-gray" id="chart">
    	<div class="container">
			<div ng-controller="sample" ng-init="tab = 1">
				<div class="row" >
			        <div class="cb" ng-click="tab = 1">x,y</div>
			        <div class="cb" ng-click="tab = 2">y.z</div>
			        <div class="cb" ng-click="tab = 3">x,z</div>
		    	</div>
		        <div class="row" style="height: 335px;">
		        	<div class="col-md-6" style="height: 100%; width: 50%;">
				        <div ng-show="tab == 1" >
				             <div id="chartContainer1"></div>
				        </div>
				        <div ng-show="tab == 2" >
				             <div id="chartContainer2"></div>
				        </div>
				        <div ng-show="tab == 3" >
				             <div id="chartContainer3"></div>
				        </div>
			    	</div>
					<div class="col-md-6" id="chartContainer4" style="height: 100%; width: 50%;"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">&nbsp;<br />&nbsp;</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-3" id="chartTable"></div>
			</div>
		</div>
    </section>
    
    <!-- Skills end -->

	
	<!-- Scroll to top -->
	<div class="scroll-up">
		<a href="#home"><i class="fa fa-angle-up"></i></a>
	</div>
    <!-- Scroll to top end-->

	<!-- Javascript files -->
    <!-- <script src="assets/js/jquery-1.11.1.min.js"></script> -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.parallax-1.1.3.js"></script>
	<script src="assets/js/imagesloaded.pkgd.js"></script>
	<script src="assets/js/jquery.sticky.js"></script>
	<script src="assets/js/smoothscroll.js"></script>
	<script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.easypiechart.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.cbpQTRotator.js"></script>
	<script src="assets/js/custom.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js"></script>

	<script type="text/javascript">
	var kmlLayer, map;
	function initialize() {
	  	var mapCanvas = document.getElementById('map-canvas');
		var mapOptions = {
			//center: new google.maps.LatLng(44.5403, -78.5463),
			center: new google.maps.LatLng(1.3147308,103.8470128),
			zoom: 13,
			mapTypeId: google.maps.MapTypeId.ROADMAP // TERRAIN
		}
	  	map = new google.maps.Map(mapCanvas, mapOptions);

		//var kmlUrl = 'http://ssl.schogini.com/rebecca/Land_Use_Website_Demo/westcampus.kml';
		// var kmlUrl = 'http://maps.google.com/maps?q=http://ssl.schogini.com/rebecca/Land_Use_Website_Demo/roadNetwork.kmz';
		// var kmlUrl = 'http://ssl.schogini.com/rebecca/Land_Use_Website_Demo/test.kml';
		// var kmlUrl = 'http://ssl.schogini.com/rebecca/Land_Use_Website_Demo/doc.kml?aaa';
		//var kmlUrl = 'http://ssl.schogini.com/rebecca/Land_Use_Website_Demo/hundred.kml';
		var kmlUrl = 'http://ssl.schogini.com/rebecca/Land_Use_Website_Demo/mapping2/kml.php?<?php echo date("dmyHis");?>.kml';
		var kmlOptions = {
			//suppressInfoWindows: true,
			//preserveViewport: false,
			map: map
		};
		kmlLayer = new google.maps.KmlLayer(kmlUrl, kmlOptions); 
		google.maps.event.trigger(map, 'resize');
	}        
  	function displayMap() {
    	document.getElementById('map-canvas').style.display="block";
    	initialize();

    	console.log('Map Initialize: ' + window.kmlLayer.url);
	}
 	google.maps.event.addDomListener(window, 'load', displayMap);

 	function refreshMap() {
 		//remove layer
        window.kmlLayer.setMap(null);
        //change its url so that we would force the google to refetch data
        window.kmlLayer.url = "http://ssl.schogini.com/rebecca/Land_Use_Website_Demo/mapping2/kml.php?w1=" + $('#weight1').val() + "&w2=" + $('#weight2').val() + "&w3=" + $('#weight3').val() + "&rand="+(new Date()).valueOf()+".kml";
        //and re-add layer
        window.kmlLayer.setMap(window.map);

        console.log('Map Refreshed: ' + window.kmlLayer.url);
        return true;
 	}
	</script>
</body>
</html>