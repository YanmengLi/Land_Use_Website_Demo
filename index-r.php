<?php
date_default_timezone_set('Asia/Singapore');
session_start();

// On page load clear the session
// The scripts that use this data will be called via Ajax Only.
// Hence, if, the page is reloaded it means we want to start fresh.
// if (isset($_SESSION['csvdata'])) unset($_SESSION['csvdata']);
// @file_put_contents('mapping2/session-log2.txt', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Land Use Allocation</title>

	<!-- CSS -->
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
	<link href="assets/css/simple-line-icons.css" rel="stylesheet" media="screen">
	<link href="assets/css/animate.css" rel="stylesheet">
    
	<script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>					  
	<script type="text/javascript" src="assets/js/jquery.canvasjs.min.js"></script>
	
	<!-- chart demo1 -->
	<script type="text/javascript">
	// The charts
	var chart1;
	var chart2;
  	window.onload = function () {
		chart1 = new CanvasJS.Chart("chartContainer1", {
			backgroundColor: "#F5F5F5",
			title: {
				text: "Chart Demo"
			},
            	animationEnabled: true,
			data: [{
				type: "spline", //change it to line, area, column, pie, etc
				dataPoints: [
					{ x: 10, y: 10 },
					{ x: 20, y: 12 },
					{ x: 30, y: 8 },
					{ x: 40, y: 14 },
					{ x: 50, y: 6 },
					{ x: 60, y: 24 },
					{ x: 70, y: -4 },
					{ x: 80, y: 10 }
				]
			}]
		});
		chart1.render();

		chart2 = new CanvasJS.Chart("chartContainer2", {
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
		        markerSize: 0, 
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
    <section class="pfblock" id="manual_table" align="center">
	
<div><h2>Manual Solution Selection</h2>
    		<select id="solution_id">
    			<option value="-1">None</option>
    			<option value="1">Sol1</option>
    			<option value="2">Sol2</option>
    			<option value="3">Sol3</option>
    			<option value="4">Sol4</option>
    			<option value="5">Sol5</option>
    			<option value="6">Sol6</option>
    			<option value="7">Sol7</option>
    			<option value="8">Sol8</option>
    			<option value="9">Sol9</option>
    			<option value="10">Sol10</option>
    			<option value="11">Sol11</option>
    			<option value="12">Sol12</option>
    			<option value="13">Sol13</option>
    			<option value="14">Sol14</option>
    			<option value="15">Sol15</option>
    			<option value="16">Sol16</option>
    			<option value="17">Sol17</option>
    			<option value="18">Sol18</option>
    			<option value="19">Sol19</option>
    			<option value="20">Sol20</option>
    			<option value="21">Sol21</option>
    			<option value="22">Sol22</option>
    			<option value="23">Sol23</option>
    			<option value="24">Sol24</option>
    			<option value="25">Sol25</option>
    			<option value="26">Sol26</option>
    			<option value="27">Sol27</option>
    			<option value="28">Sol28</option>
    			<option value="29">Sol29</option>
    			<option value="30">Sol30</option>
    		</select>
    		<input type="button" name='manual_map' value="Manual Map" onClick="refreshMap2();">
    		</div><!-- .container -->
	</section>
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
			<div class="row">
				<div class="col-md-6" id="chartContainer1" style="height: 335px; width: 50%;"></div>
				<div class="col-md-6" id="chartContainer2" style="height: 335px; width: 50%;"></div>
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
 		$('#solution_id').val("None");

 		// $("#solution_id").filter(function() {
   //  		return $(this).text() == '-1'; 
			// }).prop('selected', true);
	// $("select#solution_id option")
	//    .each(function() { this.selected = (this.text == 'None'); });

 		console.log('Inside refreshMap');
 		// //remove layer
         window.kmlLayer.setMap(null);
   //      //change its url so that we would force the google to refetch data
         window.kmlLayer.url = "http://ssl.schogini.com/rebecca/Land_Use_Website_Demo/mapping2/kml.php?w1=" + $('#weight1').val() + "&w2=" + $('#weight2').val() + "&w3=" + $('#weight3').val() + "&solution_id=" + $('#solution_id').val() + "&rand="+(new Date()).valueOf()+".kml";
   //      //and re-add layer
         window.kmlLayer.setMap(window.map);

   //      console.log('Map Refreshed: ' + window.kmlLayer.url);
        return true;
 	}	
 	function refreshMap2() {
 		console.log('Inside refreshMap');
 		// //remove layer
         window.kmlLayer.setMap(null);
   //      //change its url so that we would force the google to refetch data
         window.kmlLayer.url = "http://ssl.schogini.com/rebecca/Land_Use_Website_Demo/mapping2/kml.php?w1=-1&w2=-1&w3=-1&solution_id=" + $('#solution_id').val() + "&rand="+(new Date()).valueOf()+".kml";
   //      //and re-add layer
         window.kmlLayer.setMap(window.map);

   //      console.log('Map Refreshed: ' + window.kmlLayer.url);
        return true;
 	}
	</script>
</body>
</html>