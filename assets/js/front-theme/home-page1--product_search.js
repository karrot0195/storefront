(function($) {
  $(document).on('click', '.js-show-wrap-product', function() {
    if ($('#page.one-page').length) {
      window.location = '/shop?action=search';
    } else {
      $('.wrap-search-product').slideToggle(300);
    }
  });

  $(document).on('click', '.wrap-search-product .close', function() {
    $('.wrap-search-product').slideUp(300);
  });

  $(document).on('click', '.js-remind-text', function() {
    $('.js-input-search').val($(this).html());
  });

  $(document).on('keyup', '.js-input-search', function(e) {
    // enter
    ProcessSearchTrigger();
  });

  $(document).on('change', '.js-input-search', function(e) {
    // enter
    ProcessSearchTrigger();
  });


  let processSearch = false;
  const searchDefaultHtml = $('.block-content--main').html();
  let beforeText = '';
  function ProcessSearchTrigger() {
    const text = $('.js-input-search').val();
    if (!processSearch && beforeText.trim() != text.trim()) {
      processSearch = true;
      let html = '';
      let remindHtml = '';
      $('.search-content-remind').addClass('processing')
      try {
        if (text.length) {
          jQuery.ajax({
            url: `${home_url}?wc-ajax=ysm_product_search&query=${text}`,
            method: 'get'
          }).then(function(res) {
            const json = JSON.parse(res);
            json.suggestions.map((row, idx) => {
              html += row.item_html;
            if (idx < 2) {
              remindHtml += `<li class="js-remind-text">${row.value}</li>`;
            }
          });
            $('.search-content-remind').html(remindHtml);
            $('.search-content-remind').removeClass('processing');
            $('.block-content--main').fadeOut(300, function() {
              $('.block-content--main').html(html);
            }).fadeIn(300, function() {
              beforeText = text;
              processSearch = false;
            });
          });
        } else {
          html = searchDefaultHtml;
          $('.block-content--main').fadeOut(300, function() {
            $('.block-content--main').html(html);
          }).fadeIn(300, function() {
            processSearch = false;
          });
        }
      } catch (error) {
        processSearch = false;
      }
    }
  }
})(jQuery);
/* END CUSTOM */