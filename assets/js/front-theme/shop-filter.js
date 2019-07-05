(function($) {
  $('.js-filter-product').on('click', function () {
    let query = '';
    $('.loop-main-product').animate({
      opacity: 0
    }, 500);
    $(this).parents('.block-content').find('li.is-selected').each(function () {
      const sub_cat = $(this).data('sub_cat');
      const cat = $(this).parents('.cat-content').data('cat');
      query += `&cat[${cat}]=${sub_cat}`;
    });
    $.ajax({
      url: `${my_ajax_object.ajax_url}?action=storefront_filter_product${query}`,
      method: 'get'
    }).then(res => {
      $('.loop-main-product').html(res);
      $('.loop-main-product').animate({
      opacity: 1
    }, 500);
    });
  });
})(jQuery);
