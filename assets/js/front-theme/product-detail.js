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
          const parent = $(this).parents('.fm-detail-cart');
          const total = parent.find('#number .val').html();
          const productId = parent.data('product_id');

          if (total >= 0) {
            setItemCart(productId, total, function(res) {
              if (res.success) {
                let text = self.html();
                self.html('DONE');
                self.addClass('proccess');
                setTimeout(() => {
                  self.html(text);
                self.removeClass('proccess');
              }, 4000);
              }
            });
          }
        }
      });

      $(document).on('click', '.fm-detail-cart .js-btn-add-to-cart',  function () {
        $(this).addClass('btn-add-to-cart-click');
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

