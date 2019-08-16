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
		max: 7500,
		value: 4000,
		tooltipFormat: tooltipVal2,
		change: function (args) {
			var amount = args.value;
            var plantSize = parseFloat(amount / 750).toFixed(0);
            var money_saving = parseFloat((plantSize * 750)).toFixed(0);
            var loadAmount = (parseFloat(plantSize) * 1500).toFixed(0);
            $('.plantSize').text(plantSize+'kW');
            money_saving = Math.round(money_saving/1000)*1000;
            money_saving = money_saving - 500;
            loanAmount = Math.round(loanAmount/1000)*1000;
        	$('.money_saving').text('₹'+money_saving);
        	$('.loadAmount').text('₹'+loanAmount);
        	$('#monthly').val(amount);
        	$('#plant_size').val(plantSize);
        	$('#monthly').val(amount);
        } ,
	});

	function tooltipVal2(args) {
		return "₹ " + args.value;
	}

	$(".custom_select").dropkick({
		mobile: true
	});

})

$(window).resize(function(){
	$(".price_slider").roundSlider({
		radius: 125,
		circleShape: "pie",
		sliderType: "min-range",
		value: 500,
		startAngle: 315,
		min: 500,
		max: 7500,
		value: 4000,
		tooltipFormat: tooltipVal2,
		change: function (args) {
			var amount = args.value;
            var plantSize = parseFloat(amount / 750).toFixed(0);
            var money_saving = parseFloat((plantSize * 750)).toFixed(0);
            var loadAmount = (parseFloat(plantSize) * 1500).toFixed(0);
            $('.plantSize').text(plantSize+'kW');
            money_saving = Math.round(money_saving/1000)*1000;
            money_saving = money_saving - 500;
            loanAmount = Math.round(loanAmount/1000)*1000;
        	$('.money_saving').text('₹'+money_saving);
        	$('.loadAmount').text('₹'+loanAmount);
        	$('#monthly').val(amount);
        	$('#plant_size').val(plantSize);
        	$('#monthly').val(amount);
        } ,
	});
	function tooltipVal2(args) {
		return "₹ " + args.value;
	}
})

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