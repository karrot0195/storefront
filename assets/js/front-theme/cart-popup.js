(function ($) {
  if ($('.js-cart-header').length) {
    $(document).on('add-cart', function () {
      const url = `${my_ajax_object.ajax_url}?action=get_html_popup_cart`;
      $.get(url, function (res) {
        $('.wrap-cart-side').html(res);
      });
    });

    $('.js-cart-header').on('click', function () {
      var top = $(document).scrollTop();
      $('body').addClass('disable');
      // $('.wrap-cart-side .block-cart-side').css('top', top);
      $('.wrap-cart-side').addClass('active');
    });

    $(document).on('click', '.wrap-cart-side .close', function () {
      $('.wrap-cart-side').removeClass('active');
      $('body').removeClass('disable');
    });
  }
})(jQuery);