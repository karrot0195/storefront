(function($) {
  $(document).on('click', '.js-block-write-comment', function() {
    showModal($('#review_form_wrapper').html(), (wrap) => {
      wrap.find('.comment-notes').remove();
      wrap.find('.comment-reply-title').remove();
      wrap.find('.modal-title').html('Add a review');
    });
  });
  $(document).on('click', '.wrap-modal span.close', function() {
    $('body').removeClass('modal');
    $('.wrap-modal').fadeOut(500);
  })

})(jQuery);

window.showModal = function (html, beforeShow=null, afterShow=null) {
  jQuery('body').addClass('modal');
  const wrap = jQuery('.wrap-modal');
  wrap.find('.modal-content--main').html(html);
  if (beforeShow) beforeShow(wrap);
  wrap.fadeIn(500);
  if (afterShow) afterShow(wrap);
};
