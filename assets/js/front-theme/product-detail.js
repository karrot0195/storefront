(function($) {
  setTimeout(function() {
    $('.js-block-write-comment').on('click', function() {
      console.log(123);
      $('#review_form_wrapper').toggle();
    });
  }, 100);
})(jQuery);
