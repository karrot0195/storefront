(function($) {
  $('.js-btn-slider').on('click', function () {
    const idx = $(this).data('id') + 1;
    $(this).parents('.slider--item').hide('slider');
    $('.slider--item:nth-child('+idx+')').show('slider');
  });
})(jQuery);