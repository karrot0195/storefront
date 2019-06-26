(function($) {
  $('.js-btn-slider').on('click', function () {
    const idx = $(this).data('id') + 1;
    $(this).parents('.slider--item').hide('slider');
    $('.slider--item:nth-child('+idx+')').show('slider');
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
  // $('.number-test').slick({
  //   dots: true,
  //   speed: 500
  // });
})(jQuery);
