function setAncre(){
    var $ = jQuery;
    if($(this).attr('id') == 'cn-accept-cookie') return true;
    if($(this).hasClass('tab-link')) return true;
    if($(this).hasClass('noanchor')) return true;
    if($(this).attr("href") == '#')
        scrolltop = 0;
    else
        scrolltop = $($(this).attr("href")).offset().top;

    if($('#header').css('position') == 'fixed'){
        scrolltop -= $('#header').height();
    }

	$('html, body').animate({
		scrollTop:scrolltop
	}, 'slow');

    if($(this).parents('.menu').length> 0){
        $(this).parents('.menu').find('li.menu-item').each(function(){
            $(this).removeClass('current-menu-item');
        });
        $(this).parents('li.menu-item').addClass('current-menu-item');
    }
	return false;
}

jQuery(function($) {
  if($('#header.header-fixed').length>0){
		$('#main').css('margin-top',$('#header').outerHeight(true));

    function setHeaderScroll(){
        if($(window).scrollTop()>0){
            $('#header').addClass('header-scrolled');
        }
        else{
            $('#header').removeClass('header-scrolled');
        }
    }
    $(window).scroll(function(){ setHeaderScroll();});
    $(window).load(function(){ setHeaderScroll();});
	}

  $('body').removeClass('nojs');


  $('#mobile-toggle').click(function(){
		$('#mobile-nav').slideToggle();
	});

  // active le glissement pour les ancres
  $('body').on('click','a[href^="#"]',setAncre);
});
