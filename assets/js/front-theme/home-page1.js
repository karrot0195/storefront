(function($) {
  $('.js-btn-slider').on('click', function () {
    const idx = $(this).data('id') + 1;
    $(this).parents('.slider--item').fadeOut(300);
    $('.slider--item:nth-child('+idx+')').fadeIn(300);
  });
  // Show the first tab by default
	$('.tabs-stage section').hide();
	$('.tabs-stage section:first').show();
	$('.tabs-nav li:first').addClass('tab-active');

	// Change tab class and display content
	$('.tabs-nav a').on('click', function(event){
	event.preventDefault();
	$('.tabs-nav li').removeClass('tab-active');
	$(this).parent().addClass('tab-active');
	$('.tabs-stage section').hide();
	$($(this).attr('href')).show();
  });
  $('.slider-tab-1').slick({
    dots: false,
    arrows: true,
    speed: 500,
  });
  $('.slider-tab-2').slick({
    dots: false,
    arrows: true,
    speed: 500,
  });
  $('.slider-tab-3').slick({
    dots: false,
    arrows: true,
    speed: 500,
  });
})(jQuery);
