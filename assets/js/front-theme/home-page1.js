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
  $(document).on('click','.js-videoPoster',function(e) {
    //отменяем стандартное действие button
    e.preventDefault();
    var poster = $(this);
    // ищем родителя ближайшего по классу
    var wrapper = poster.closest('.js-videoWrapper');
    videoPlay(wrapper);
  });
  
  //вопроизводим видео, при этом скрывая постер
  function videoPlay(wrapper) {
    var iframe = wrapper.find('.js-videoIframe');
    // Берем ссылку видео из data
    var src = iframe.data('src');
    // скрываем постер
    wrapper.addClass('videoWrapperActive');
    // подставляем в src параметр из data
    iframe.attr('src',src);
  }
})(jQuery);



window.increaseValue = function() {
  console.log('aaa');
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('number').value = value;
}

window.decreaseValue = function() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  document.getElementById('number').value = value;
}
