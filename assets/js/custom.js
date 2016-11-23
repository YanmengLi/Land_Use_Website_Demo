(function($){

	/* ---------------------------------------------- /*
	 * Preloader
	/* ---------------------------------------------- */

	$(window).load(function() {
		$('#status').fadeOut();
		$('#preloader').delay(300).fadeOut('slow');
	});

	$(document).ready(function() {

		/* ---------------------------------------------- /*
		 * Smooth scroll / Scroll To Top
		/* ---------------------------------------------- */

		$('a[href*=#]').bind("click", function(e){
           
			var anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $(anchor.attr('href')).offset().top
			}, 1000);
			e.preventDefault();
		});

		$(window).scroll(function() {
			if ($(this).scrollTop() > 100) {
				$('.scroll-up').fadeIn();
			} else {
				$('.scroll-up').fadeOut();
			}
		});

		/* ---------------------------------------------- /*
		 * Navbar
		/* ---------------------------------------------- */

		$('.header').sticky({
			topSpacing: 0
		});

		$('body').scrollspy({
			target: '.navbar-custom',
			offset: 70
		});

		/* ---------------------------------------------- /*
		 * Skills
        /* ---------------------------------------------- */
        //var color = $('#home').css('backgroundColor');

        $('.skills').waypoint(function(){
            $('.chart').each(function(){
            $(this).easyPieChart({
                    size:140,
                    animate: 2000,
                    lineCap:'butt',
                    scaleColor: false,
                    barColor: '#FF5252',
                    trackColor: 'transparent',
                    lineWidth: 10
                });
            });
        },{offset:'80%'});
        
        
        /* ---------------------------------------------- /*
		 * Quote Rotator
		/* ---------------------------------------------- */
       
			$( function() {
				/*
				- how to call the plugin:
				$( selector ).cbpQTRotator( [options] );
				- options:
				{
					// default transition speed (ms)
					speed : 700,
					// default transition easing
					easing : 'ease',
					// rotator interval (ms)
					interval : 8000
				}
				- destroy:
				$( selector ).cbpQTRotator( 'destroy' );
				*/

				$( '#cbp-qtrotator' ).cbpQTRotator();

			} );
		
        
		/* ---------------------------------------------- /*
		 * Home BG
		/* ---------------------------------------------- */

		$(".screen-height").height($(window).height());

		$(window).resize(function(){
			$(".screen-height").height($(window).height());
		});

		if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
			$('#home').css({'background-attachment': 'scroll'});
		} else {
			$('#home').parallax('50%', 0.1);
		}


		/* ---------------------------------------------- /*
		 * WOW Animation When You Scroll
		/* ---------------------------------------------- */

		wow = new WOW({
			mobile: false
		});
		wow.init();


		/* ---------------------------------------------- /*
		 * E-mail validation
		/* ---------------------------------------------- */

		function isValidEmailAddress(emailAddress) {
			var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
			return pattern.test(emailAddress);
		}

		/* ---------------------------------------------- /*
		 * Contact form ajax
		/* ---------------------------------------------- */

		$('#contact-form').submit(function(e) {

			e.preventDefault();

			var c_weight1	= $('#weight1').val();
			var c_weight2	= $('#weight2').val();
			var c_weight3	= $('#weight3 ').val();
			var response	= $('#contact-form .ajax-response');

			//if ((c_name== '' || c_email == '' || c_message == '') || (!isValidEmailAddress(c_email))) {
			if (c_weight1 === '' || c_weight2 === '' || c_weight3 === '') {
				response.fadeIn(500);
				response.html('<i class="fa fa-warning"></i> Please fix the errors and try again.');

			} else {
				$.ajax({
						//url: '/rebecca/Land_Use_Website_Demo/mapping/handleFormSubmit.php',
						url: 'http://ssl.schogini.com/rebecca/Land_Use_Website_Demo/mapping2/handleFormSubmit.php',
						method: "POST",
						dataType: "json",
						data: $('form#contact-form').serialize(),
						success: function(returndata) {
							if (returndata.status == 'success') {
								//$('#contact-form .ajax-hidden').fadeOut(500); // This will hide the contact form
								response.html(returndata.message).fadeIn(500);

								// Reload the map?
								refreshMap();

								// Reload the charts
								chart1.options.data[0].dataPoints = returndata.data.chart1;
								chart1.render();

								chart2.options.data[0].dataPoints = returndata.data.chart2;
								chart2.options.data[0].legendText = "The best solution is number " + returndata.data.bestSol;
								chart2.render();

								// Show the data table below the chart
								var activeclass = '';
								var chartTable = '<table class="table table-condensed table-striped">';
								chartTable += '<caption>Chart Data Table</capton>';
								chartTable += '<thead><tr><th>Rank</th><th>Soln ID</th><th>Obj 1</th><th>Obj 2</th><th>Obj 3</th><th>Fitness Fn</th></tr></thead><tbody>';
								for (var i in returndata.data.rank) {
									if (returndata.data.rank[i].solutionid == returndata.data.bestSol) {
										activeclass = ' class="success"';
									} else {
										activeclass = '';
									}
									chartTable += '<tr' + activeclass + '><td>' + (parseInt(i)+1) + '</td><td>' + returndata.data.rank[i].solutionid + '</td><td>' + returndata.data.rank[i].obj1 + '</td><td>' + returndata.data.rank[i].obj2 + '</td><td>' + returndata.data.rank[i].obj3 + '</td><td>' + returndata.data.rank[i].solution + '</td></tr>';
								}
								chartTable += '</tbody></table>';
								$('#chartTable').html(chartTable);

								// scroll to the map
								$('html, body').stop().animate({scrollTop: $('#map').offset().top}, 1000);

							} else {
								response.fadeIn(500);
								response.html('<i class="fa fa-warning"></i> Please fix the errors and try again.');
								
							}
						}
					});

					// $('#contact-form .ajax-hidden').fadeOut(500);
					// response.html("Message Sent. I will contact you asap. Thanks.").fadeIn(500);
				}
            
				return false;
			});

	});

})(jQuery);