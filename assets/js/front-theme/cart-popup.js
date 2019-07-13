(function ($) {
  if ($('.js-cart-header').length) {
    $('.js-cart-header').on('click', function () {
      var top = $(document).scrollTop();
      $('body').addClass('disable');
      $('.wrap-cart-side .block-cart-side').css('top', top);
      $('.wrap-cart-side').addClass('active');
    });

    $('.wrap-cart-side .close').on('click', function () {
      $('.wrap-cart-side').removeClass('active');
      $('body').removeClass('disable');
    });
  }
})(jQuery);