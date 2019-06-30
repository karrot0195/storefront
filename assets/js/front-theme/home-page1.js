(function($) {
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
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          arrows: false,
          dots: true,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          arrows: false,
          dots: true,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          dots: true,
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
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


  /* EFFECT LIKE, SHARE */
  $('.block-share .fa-share-alt').click(function(){
    $('.block-share').toggleClass('block-share-click');
   $('.block-share--conent').toggleClass('block-share--conent-click');
    $('.block-share--conent li').toggleClass('effect-fb');
    console.log('hdhc');
  });


  $(".block-like").on('click touchstart', function(){
    $(this).toggleClass('is_animating');
  });
  
  /*when the animation is over, remove the class*/
  $(".block-like").on('animationend', function(){
    $(this).toggleClass('is_animating');
  });
})(jQuery);


/* CUSTOM EVENT */
(function($) {

  // [HOME PAGE] COOKIE
    if ($('.js-requirecookie').length > 0) {
      const $container = $('.js-requirecookie').parents('.container');
      $('.js-requirecookie').on('click', () => {
        $container.fadeOut(300);
      });
  }


  // [HOME PAGE] EVENT SLIDER
  $('.js-btn-slider').on('click', function() {
    let src = $(this).data('src');
    let desc = $(this).data('description');
    $('.js-btn-slider').removeClass('active');
    $(this).addClass('active');
    $('img.bg-img').fadeOut(300, function() {
      $('img.bg-img').attr('src', src);
      $('.slider--item .block-desc').html(desc);
    })
      .fadeIn(300);
  });

  // [SHOP] BUTTON CART
    if ( $('.js-cart-btn').length) {
      let isProcessing = false;
      $('.js-cart-btn').on('click', function () {
        if (!isProcessing) {
          isProcessing = true;
          try {
            const parent = $(this).parents('.fm-sl-cart');
            const self = $(this);
            const val = parseInt($(this).data('val'));
            const productId = parent.data('product_id');
            const $input = parent.find('#number .val');
            let total = parseInt($input.html());
            if (total + val >= 0) {
              total = total + val;
              setItemCart(productId, total, function (res) {
                if (res.success) {
                  $('a.footer-cart-contents').html(`<span class="count">${res.total}</span>`);

                  $input.slideToggle(300, function () {
                    $input.html(total);
                    $input.slideToggle(300);
                  });


                  if (total == 0) {
                    parent.removeClass('proccessing');
                  } else {
                    parent.addClass('proccessing');
                  }
                }
                isProcessing = false;
              });
            }
          } catch (e) {
            isProcessing = false;
          }
        }
      });
    }
}(jQuery));

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

/* END CUSTOM */
