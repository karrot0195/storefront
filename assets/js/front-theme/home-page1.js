(function($) {
  $('.js-btn-slider').on('click', function() {
    let src = $(this).data('src');
    $('.js-btn-slider').removeClass('active');
    $(this).addClass('active');
    $('img.bg-img').fadeOut(300, function() {
      $('img.bg-img').attr('src', src);
    })
      .fadeIn(300);
  });
  // Show the first tab by default
  $('.tabs-stage section').hide();
  $('.tabs-stage section:first').show();
  $('.tabs-nav li:first').addClass('tab-active');

  // Change tab class and display content
  $('.tabs-nav a').on('click', function(event) {
    event.preventDefault();
    $('.tabs-nav li').removeClass('tab-active');
    $(this).parent().addClass('tab-active');
    $('.tabs-stage section').hide();
    $($(this).attr('href')).show();
  });
  $('.slider-tab-1').slick({
    dots: false,
    arrows: true,
    speed: 500,
  });
  $('.slider-tab-2').slick({
    dots: false,
    arrows: true,
    speed: 500,
  });
  $('.slider-tab-3').slick({
    dots: false,
    arrows: true,
    speed: 500,
  });
  $(document).on('click', '.js-videoPoster', function(e) {
    //отменяем стандартное действие button
    e.preventDefault();
    var poster = $(this);
    // ищем родителя ближайшего по классу
    var wrapper = poster.closest('.js-videoWrapper');
    videoPlay(wrapper);
  });

  //вопроизводим видео, при этом скрывая постер
  function videoPlay(wrapper) {
    var iframe = wrapper.find('.js-videoIframe');
    // Берем ссылку видео из data
    var src = iframe.data('src');
    // скрываем постер
    wrapper.addClass('videoWrapperActive');
    // подставляем в src параметр из data
    iframe.attr('src', src);
  }

  let isProcessing = false;
  $('.js-cart-btn').on('click', function () {
    if (!isProcessing) {
      isProcessing = true;
      try {
        const parent = $(this).parent();
        const self = $(this);
        const val = parseInt($(this).data('val'));
        const productId = parent.data('product_id');
        let total = parseInt(parent.find('input[name=number]').val());
        if (total + val >= 0) {
          total = total + val;
          setItemCart(productId, total, function (res) {
            if (res.success) {
              $('a.footer-cart-contents').html(`<span class="count">${res.total}</span>`);
              parent.find('input[name=number]').val(total);
            }
            isProcessing = false;
          });

          const loop = setInterval(function() {
            if (isProcessing) {
              isProcessing = false;
            }
            loop.clear();
          }, 1000);
        }
      } catch (e) {
        isProcessing = false;
      }
    }
  });
  $('.moreless-button').click(function() {
    // $('.description').removeClass('active');
    var x = $(this).parent().find('.description');
    // console.log(x);
    // if(x.hasClass('active')) {
    //   x.removeClass('active');
    // }
    if ($(this).text() == "Read more") {
      $(this).text("Read less");
      x.addClass('active');
    } else {
      $(this).text("Read more");
      x.removeClass('active');
    }
  });
})(jQuery);

window.setItemCart = function(product_id, quantity, callback) {
  jQuery.ajax({
    url: my_ajax_object.ajax_url,
    data: {
      'action' : 'set_item_from_cart',
      'product_id': product_id,
      'quantity': quantity
    },
    method: 'post'
  }).then(res => {
    callback(res);
});
};

