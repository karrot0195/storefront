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

window.increaseValue = function() {
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

window.addToCart = function (product_id, quantity) {
  jQuery.ajax({
    url: `${home_url}?wc-ajax=add_to_cart`,
    data: {
      product_id: product_id,
      quantity: quantity,
      product_sku: ''
    },
    method: 'POST'
  }).then(res => {
    if (res['fragments']['a.footer-cart-contents']) {
      jQuery('a.footer-cart-contents').html(res['fragments']['a.footer-cart-contents']);
    }
  });
};