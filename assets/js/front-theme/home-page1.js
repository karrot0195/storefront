(function($) {
  // Show the first tab by default
  $('.tabs-stage section').hide();
  $('.tabs-stage section:first').show();
  $('.tabs-nav li:first').addClass('tab-active');

  // JS MENU MOBILE
  $('.menu-shop').click(function(){
    $(this).find('i').toggleClass('i-click');
    $(this).next('ul').slideToggle(300);
  });
  $('.menu-info').click(function(){
    $(this).find('i').toggleClass('i-click');
    $(this).next('ul').slideToggle(300);
  });
  
  // TAB LOGIN
  $('.title-tab .tab').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('.title-tab .tab').removeClass('tab-click');
		$('.tab-content-login').removeClass('current');

		$(this).addClass('tab-click');
		$("#"+tab_id).addClass('current');
  })
  
  // MY ACCOUNT MOBILE
  $(document).ready(function(){
    var title_tab = "<h6></h6>";
    var test =`<i class="fas fa-chevron-down"></i>`;
    $(".woocommerce-account .hentry .entry-content .woocommerce .woocommerce-MyAccount-navigation").prepend(title_tab);
    var htmlString = $( '.woocommerce-account .hentry .entry-content .woocommerce .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link.is-active a' ).text();
    $('h6').text( htmlString); 
    $('h6').prepend(test);
    $('.woocommerce-MyAccount-navigation h6').click(function(){
      $('.woocommerce-MyAccount-navigation ul').slideToggle(300);
      $(this).find('i').toggleClass('tab-click');
    });
  });

  // Control 1 product on mobile
  var count_product = $('ul.products li').length;
  if(count_product <= 1){
    $('ul.products').addClass('products-mb');
    $('ul.products li').addClass('product-mb');
  }

  // Change tab class and display content
  $('.tabs-nav a').on('mouseover', function(event) {
    event.preventDefault();
    $('.tabs-nav li').removeClass('tab-active');
    $(this).parent().addClass('tab-active');
    $('.tabs-stage section').hide();
    $($(this).attr('href')).fadeIn(700);
  });

  $('.tabs-nav a').on('click', function(event) {
    event.preventDefault();
    $('.tabs-nav li').removeClass('tab-active');
    $(this).parent().addClass('tab-active');
    $('.tabs-stage section').hide();
    $($(this).attr('href')).fadeIn(700);
  });

  // Menu Mobile
  $('.hamburger-menu').on('click', function(){
    $(this).parent().find('.menu-mobile').toggleClass('open-menu-mobile');
  });
  $('.hamburger-menu.close').on('click', function(){
    $(this).parent('.menu-mobile').toggleClass('open-menu-mobile');
  });

  // Click outside Menu
// $(document).on('click', function (e) {
//   const $menu = $('.menu-mobile');
//   const $hamburger = $('.hamburger-menu');
//   if ((!$menu.is(e.target) // if the target of the click isn't the container...
//     && $menu.has(e.target).length === 0) || (!$hamburger.is(e.target) // if the target of the click isn't the container...
//     && $hamburger.has(e.target).length === 0)) // ... nor a descendant of the container
//   {
//     $menu.removeClass('open-menu-mobile');
//  }
// });


  // Scroll Menu 
  $(window).scroll(function(){
      if ($(this).scrollTop() > 1) {
        $('.site-header').addClass('fixed');
      } else {
        $('.site-header').removeClass('fixed');
      }
  });
  // Filter
  $('.btn-filter').on('click', function(){
    $('.button-close').show(300);
    $('.modal-filter').slideToggle(300);
    $(this).hide();
  })

  // Close Modal Filter
  $('.button-close').on('click', function() {
    $('.modal-filter').slideToggle(300);
    $('.info-page-child .btn-filter').show(300);
    $('.button-close').hide();
  });
 
  $('.button-close-sp').on('click', function(){
    $('.modal-filter').slideToggle(300);
  });

  // Choose Filter
  $('.content-1 ul li button').on('click', function() {
    $('.content-1 ul li').removeClass('is-selected');
    $(this).parent().addClass('is-selected');
  });

  $('.content-2 ul li button').on('click', function() {
    $('.content-2 ul li').removeClass('is-selected');
    $(this).parent().addClass('is-selected');
  });

  $('.content-3 ul li button').on('click', function() {
    $('.content-3 ul li').removeClass('is-selected');
    $(this).parent().addClass('is-selected');
  });

  $('.CPFilterItem-trigger').on('click', function(){
    $(this).parents('.content').toggleClass('is-opened');
    $(this).parents('.content').find('ul').slideToggle(300);
    $(this).parents('.title-wrapper').find('.title-show').toggleClass('title-hide');
    var test = $(this).parents('.content').find('.is-selected');
    var totaltest = $test.text(); 
    console.log(totaltest);
  });


  $('.slider-tab-1').slick({
    dots: false,
    arrows: true,
    speed: 500,
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
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

  $('.related-slider').slick({
    dots: false,
    arrows: true,
    speed: 500,
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          arrows: false,
          dots: true,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
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

  // SHOW POPUP REVIEW
  $('.contribution-type-selector .js-switch-contribution-type').click(function(){
    $('body').addClass('disable');

    if ($('#review_form_wrapper .close').length == 0) {
      $('#review_form_wrapper form').prepend(`<div class="close"><i class="icon ion-md-close"></i></div>`);
      $('#review_form_wrapper .close').on('click', function () {
        $('.popup-background').css('opacity', '0');
        $('.popup-background').remove();
        $('#review_form_wrapper').removeClass('show');
        $('body').removeClass('disable');
      });
    }
    $('#review_form_wrapper').addClass('show');
    if ($('.popup-background').length == 0) {
      const style = "opacity: 0; position: fixed;width: 100%;height: 100%;z-index: 999;background: #00000054;top: 0;left: 0; transision: all 0.3 ease;";
      $(`<div class="popup-background" style="${style}"> </div>`).insertBefore($('#reviews'));
    }
    $('.popup-background').css('opacity', '1');
    $('#review_form_wrapper').addClass('show');
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
        $container.fadeOut(800);
      });
  }


  // [HOME PAGE] EVENT SLIDER
  $.fn.imgLoad = function(callback) {
        return this.each(function() {
            if (callback) {
                if (this.complete || /*for IE 10-*/ $(this).height() > 0) {
                    callback.apply(this);
                }
                else {
                    $(this).on('load', function(){
                        callback.apply(this);
                    });
                }
            }
        });
    };

	$("img.bg-img").imgLoad(function () {
		setTimeout(() => {
			$('img.bg-img').animate({opacity: 1}, 300);
		}, 300);	
	});

  $('.js-btn-slider').on('hover', function() {
     if (!$(this).hasClass('active')) {
      let src = $(this).data('src');
      let desc = $(this).data('description');
      $('.js-btn-slider').removeClass('active');
      $(this).addClass('active');
      $('img.bg-img').fadeOut(300, function () {
        $('img.bg-img').attr('src', src);
        $('.slider--item .block-desc').html(desc);
        $('img.bg-img').fadeIn();
      });
     }
  });

  // [SHOP] BUTTON CART
    if ( $('.js-cart-btn').length) {
      let isProcessing = false;
      $(document).on('click', '.js-cart-btn', function () {
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

              let oldtotal = total;
              total = total + val;
              setItemCart(productId, total, function (res) {
                if (res.success) {
                  $('a.cart-header').html(`<span class="count">${res.total}</span>`);
                  $(document).trigger('add-cart');

                  $input.slideToggle(100, function () {
                    $input.html(total);
                    // $input.fadeIn();
                    if(oldtotal > total){
                      $input.addClass('dec-1');
                      setTimeout(function(){ 
                        $input.addClass('dec-2');
                      }, 200);
                      setTimeout(function(){ 
                        $input.addClass('dec-3');
                      }, 300);
                      setTimeout(function(){ 
                        $input.removeClass('dec-1');
                        $input.removeClass('dec-2');
                        $input.removeClass('dec-3');
                      }, 400);
                    } else{
                      $input.addClass('inc-1');
                      setTimeout(function(){ 
                        $input.addClass('inc-2');
                      }, 200);
                      setTimeout(function(){ 
                        $input.addClass('inc-3');
                      }, 300);
                      setTimeout(function(){ 
                        $input.removeClass('inc-1');
                        $input.removeClass('inc-2');
                        $input.removeClass('inc-3');
                      }, 400);
                    }
        
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

  // [ABOUT US] SLICK SLIDER
  $ ('.slider').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false
  });

  // [FAQ] TOGGLE DROPDOWN
  $('.block__content .title').click(function(){
    // $('.block__content').find('.sub-title').hide();
    $(this).toggleClass('title-click');
    $(this).next('.sub-title').slideToggle(200);
  });

  // [MY ACCOUNT] TAB CONTENT
  $('.sidebar .sidebar__tab').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('.sidebar .sidebar__tab').removeClass('current');
		$('.tab-content-mc').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

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

/* CUSTOM FORM QUANTITY */ 
jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
jQuery('.quantity').each(function() {
  var spinner = jQuery(this),
    input = spinner.find('input[type="number"]'),
    btnUp = spinner.find('.quantity-up'),
    btnDown = spinner.find('.quantity-down'),
    min = input.attr('min'),
    max = input.attr('max');

  btnUp.click(function() {
    var oldValue = parseFloat(input.val());
      var newVal = oldValue + 1;
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  btnDown.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue <= min) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue - 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

});

/* END CUSTOM */


