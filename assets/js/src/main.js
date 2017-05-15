jQuery( document ).ready(function($) {

	$('.slider').flickity();

	var scrollTop = $('#scroll-to-top');

	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			scrollTop.fadeIn();
		} else {
			scrollTop.fadeOut();
		}
	});
	
	//Click event to scroll to top
	scrollTop.click(function(e){
		e.preventDefault();
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});

	$("#mobile-menu").on('click',function(e) {
		e.preventDefault();
	   	$('.hamburger-menu .bar').toggleClass('is-active');
	   	$('.menu-main-menu-container').toggleClass('is-active');
	});

	$(".no-click").on('click',function(e) {
		e.preventDefault();
	   	$(this).toggleClass('submenu-is-active');
	});
	
	$('.search-button').on('click', function(e){
		e.preventDefault();
		$('#search-form-overlay').addClass('is-active');
		containers_no_scroll();
	});

	$('.close-search').on('click', function(e){
		e.preventDefault();
		$('#search-form-overlay').removeClass('is-active');
		containers_no_scroll();
	});

	if( $('.header_sticky').length > 0 ) {
		$(function() {
			console.log('test');
		    var menu, menuInner ,$document, didScroll, offset;
		    menuInner = $('.main-header-area');
		    menu = $('#mastheader');
		    offset = 600;
		    $document = $(document);
		    didScroll = false;
		    $(window).on('scroll touchmove', function() {
		      return didScroll = true;
		    });
		    return setInterval(function() {
		      if (didScroll) {
		      	
		      	if( $document.scrollTop() > offset ) {
		      		menu.addClass('is-sticky');
		      		menuInner.addClass('in-active');
		      		window.setTimeout(function(){menu.addClass('top-animate');}, 100);
		      	}else {
		      		menu.removeClass('is-sticky top-animate');
		      		menuInner.removeClass('in-active');
		      	}
		      	
		        return didScroll = false;
		      }
		    }, 250);
		});
	}

	// Removing / adding on html, body
	function containers_no_scroll(){
		$('html, body').toggleClass('no-scroll');
	}
	
});