(function($) {
  $(document).on('click', '.js-show-wrap-product',function () {
    if ($('#page.one-page').length) {
      window.location = '/shop?action=search';
    } else {
      $('.wrap-search-product').slideToggle(300);
    }
  });

  $(document).on('click', '.wrap-search-product .close',function () {
    $('.wrap-search-product').slideUp(300);
  });


  $(document).on('keyup', '.js-input-search', function (e) {
    // enter
    if (e.keyCode == 13) {
      jQuery.ajax({
        url: my_ajax_object.ajax_url,
        data: {
          'action' : 'search_product',
          'text': $('.js-input-search').val()
        },
        method: 'post'
      }).then(function (res) {
        if (res.success) {
          $('.block-content--main').fadeOut(300, function () {
            $('.block-content--main').html(res.html);
          }).fadeIn(300);
        }
      });
    }
  });
})(jQuery);
/* END CUSTOM */