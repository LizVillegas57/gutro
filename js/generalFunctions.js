(function($) {

	var secondaryMenu = $('.secondaryMenu'),
		secondaryMenuAnchor = $("#secondaryMenu ul li a"),
		loading = $('.loading'),
		wrapper = $('.wrapper'),
		scrollToTop = $('.scrollToTop'),
		scrollToBottom = $(".scrollToBottom"),
		weDo = $("#weDo"),
		clients = $("#clients"),
		customNavigation = $('.customNavigation'),
		customNavigationHeight = $('.customNavigation').height(),
		sliderHome = $('.sliderHome img').height(),
		totalHeight = customNavigationHeight + sliderHome,
		secondaryMenuHeight = secondaryMenu.height(),
		scrolled = 0;

	if ($('#home')[0]){
		//Loading Function
		loading.delay(2500).fadeOut('slow');
		setTimeout(function() {
			wrapper.fadeIn('slow').removeClass('hidden');
		}, 3000);

		//Secondary Menu Function
	    $(window).scroll(function () {
	        if ($(this).scrollTop() > totalHeight) {
	            secondaryMenu.addClass("fixed");
	        } else {
	            secondaryMenu.removeClass("fixed");
	        }
	    });

	    //Click event to scroll to top
		scrollToTop.click(function(){
			$('html, body').animate({scrollTop : 0},800);
			secondaryMenuAnchor.removeClass('active');
			weDo.removeClass('paddingTop');
			clients.removeClass('paddingTop');
			return false;
		});

		//Click event to scroll to bottom
		scrollToBottom.click(function(){
            scrolled = scrolled + totalHeight;
			$('html, body').animate({scrollTop:  scrolled});
		   	secondaryMenuAnchor.removeClass('active');
		   	weDo.removeClass('paddingTop');
			clients.removeClass('paddingTop');
			scrolled = 0;
		});

		//SecondaryMenu function 
		secondaryMenuAnchor.on('click', function(e) {
			weDo.removeClass('paddingTop');
			clients.removeClass('paddingTop');
			secondaryMenuAnchor.removeClass('active');
			$(this).addClass('active');
		   	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		      	var target = $(this.hash);
		      	target.addClass('paddingTop');
		      	target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		      	if (target.length) {
		        	$('html,body').animate({
		          		scrollTop: target.offset().top
		        	}, 800);
		        	return false;
		      	}
		    }
		});
	}
	else{
		//Secondary Menu Function
	    $(window).scroll(function () {
	        if ($(this).scrollTop() > 0) {
	            customNavigation.addClass("fixed");
	        } else {
	            customNavigation.removeClass("fixed");
	        }
	    });
	}

})(jQuery);