$(document).ready(function() {

	$("a[href='#']").click(function(e) {
		e.preventDefault();
	});

	/* On scroll header small */
	$(window).scroll(function(e) {
		if($(window).scrollTop() > 0)
			$(".wrapper").addClass('small-header');
		else
			$(".wrapper").removeClass('small-header');
	});

	/* Placeholder */
	$("[placeholder]").each(function () {
		$(this).attr("data-placeholder", this.placeholder);

		$(this).bind("focus", function () {
			this.placeholder = '';
		});
		$(this).bind("blur", function () {
			this.placeholder = $(this).attr("data-placeholder");
		});
	});

	$(".hero_banner .orange_btn").click(function(){
		$("html,body").removeClass("no_scroll");
		$('html, body').animate({
			scrollTop: $(".hero_banner + .info_section").offset().top - $("header").innerHeight()
		}, 1000);
	})

	/* Price Slider */
	$(".price_slider").roundSlider({
		radius: 125,
		circleShape: "pie",
		sliderType: "min-range",
		value: 500,
		startAngle: 315,
		min: 500,
		max: 10000,
		tooltipFormat: tooltipVal2,
		change: function (args) {
            $('#monthly').val(args.value)
        } ,
	});

	function tooltipVal2(args) {
		return "₹ " + args.value;
	}

	$(document).on('keyup','.area_input',function(){
		if($('.area_input').val().length == 6){
			var pincode = $(this).val();
			$.ajax({
	            url: "/check-city-name",
	            type: "POST",
	            data:{ zip : pincode},
	            success: function(data){
	            	if(data.city != ''){
	            		$('.area_name').text(data.city);
	            	} else if(data.state != ''){
	            		$('.area_name').text(data.state);
	            	} else {
	            		$('.area_name').text('Enter other pincode');
	            	}
	            	$('#pincode').val(pincode);
	            }
	        });
		}
	});

})