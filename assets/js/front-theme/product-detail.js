(function($) {
  setTimeout(function() {
      $(document).on('click', '.fm-detail-cart .js-detail-cart-btn', function () {
          const parent = $(this).parents('.fm-detail-cart');
          const self = $(this);
          const val = parseInt($(this).data('val'));
          const productId = parent.data('product_id');
          const $input = parent.find('#number .val');
          let total = parseInt($input.html());
          if (total + val >= 0) {
            total = total + val;
            $input.html(total);
          }
      });

      $(document).on('click', '.fm-detail-cart .js-btn-add-to-cart',  function () {
        const self = $(this);
        if (!self.hasClass('proccess')) {
          self.addClass('btn-add-to-cart-click')
          const parent = $(this).parents('.fm-detail-cart');
          const total = parent.find('#number .val').html();
          let product_id = parent.data('product_id');
          if (total >= 0) {
            let text = self.html();
            if ($('.wrap-attribute-size').length) {
              const label = $('.wrap-attribute-size input:checked').parent().find('label');
              product_id = label.data('json').variation;
            }

            const url = `?add-to-cart=${product_id}&quantity=${total}`;
            $.get(url, function () {
                $.get('?action=get_total_item', function (res) {
                    $('#list-action-cart .cart-header span').html(res);
                    $(document).trigger('add-cart');


                    self.addClass('proccess');
                    self.removeClass('btn-add-to-cart-click');
                    setTimeout(() => {
                        self.removeClass('proccess');
                        self.addClass('test-f');
                        setTimeout(() => {
                          self.removeClass('test-f');
                    },1000);
                    },1000);  
                });
             });
          }
        }
      });

  }, 100);
})(jQuery);

// if no Webkit browser
(function(){
  let isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
  let isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
  let scrollbarDiv = document.querySelector('.scrollbar');
    if (!isChrome && !isSafari) {
      scrollbarDiv.innerHTML = 'You need Webkit browser to run this code';
    }
})((jQuery));

