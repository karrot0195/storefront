(function($) {
  $(document).on('click', '.js-show-wrap-product', function() {
    if ($('#page.one-page').length) {
      window.location = '/derma-rx?action=search';
    } else {
      $('.wrap-search-product').slideToggle(300);
      setTimeout(function(){
        $('.wrap-search-product .block-content--main .wrap-item .block-thumbnail img').toggleClass('img-show');
      }, 500);

      setTimeout(function(){
        $('.wrap-search-product .block-content--main .wrap-item .block-title').toggleClass('block-title-show');
      }, 1000);
    }
  });

  $(document).on('click', '.wrap-search-product .close', function() {
    $('.wrap-search-product').slideUp(300);
  });

  $(document).on('click', '.js-remind-text', function() {
    ProductSearch.configs.must_search = true;
    jQuery('.search-content-remind').html('');
    $('.js-input-search').val($(this).html());
    ProductSearch.configs.clean_remind = true;
    ProductSearch.search();
  });

  $(document).on('keyup', '.js-input-search', function(e) {
    // enter
    ProductSearch.search();
  });

})(jQuery);

const ProductSearch = {
  metas: {
    defaul_html: jQuery('.block-content--main').html(),
    pre_text: '',
    text: ''
  },
  configs: {
    proccess_search: false,
    clean_remind: false,
    must_search: true
  },
  search: function() {
    this.metas.text  = jQuery('.js-input-search').val();
    if (this.check_condition()) {
      this.beforeSeach();
      this.ajax(() => {
        this.afterSearch();
      });
    } else {
      if (this.metas.text.trim().length == 0) {
        this.defaultHtml();
      }
    }
  },
  ajax: function(callback) {
    jQuery.ajax({
      url: `${home_url}?wc-ajax=ysm_product_search&query=${this.metas.text}`,
      method: 'get'
    }).then((res) => {
      this.setHtmlResult(res);
      callback();
    });
  },
  check_condition: function() {
    if (this.configs.must_search) {
      this.configs.must_search = false;
      return true;
    }

    if (!this.configs.proccess_search &&
      this.metas.text.trim().length > 0 &&
      this.metas.pre_text.trim() != this.metas.text.trim()) {
      return true;
    }
    return false;
  },
  defaultHtml: function() {
    jQuery('.block-content--main').html(this.metas.defaul_html);
  },
  setHtmlResult: function (res, callback) {
    const json = JSON.parse(res);
    let html = '';
    let remindHtml = ''
    json.suggestions.map((row, idx) => {
      html += row.item_html;
        if (idx < 3) {
          remindHtml += `<li class="js-remind-text">${row.value}</li>`;
        }
    });
    jQuery('.block-content--main').html(html);
    jQuery('.search-content-remind').html(remindHtml);
  },
  afterSearch: function () {
    this.metas.pre_text = this.metas.text;

    jQuery('.block-content--main').animate({
      opacity: 1
    }, 300, () => {
        this.configs.proccess_search = false;
    });

    if (ProductSearch.configs.clean_remind) {
      ProductSearch.configs.clean_remind = false;
      jQuery('.search-content-remind').html('');
    }
    jQuery('.search-content-remind').animate({
      opacity: 1
    }, 300);
  },
  beforeSeach: function () {
    this.configs.proccess_search = true;
    jQuery('.block-content--main').animate({
      opacity: 0
    }, 300);

    jQuery('.search-content-remind').animate({
      opacity: 0
    }, 300);
  }
};
/* END CUSTOM */