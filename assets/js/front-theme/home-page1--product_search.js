(function($) {
  $(document).on('click', '.js-show-wrap-product', function() {
    if (!window.location.href.match(/derma-rx/)) {
      window.location = 'derma-rx?action=search';
    } else {
      $('.wrap-search-product').slideToggle(500);
    }
  });

  $(document).on('click', '.wrap-search-product .close', function() {
    $('.wrap-search-product').slideUp(500);
  });

  $(document).on('keyup', '.js-input-search', function(e) {
    // enter
    ProductSearch.search(jQuery('.js-input-search').val());
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
    queue: [],
    pre_text: ''
  },
  search: function(text) {
    if (!this.configs.proccess_search) {
      if (text.trim() != this.configs.pre_text) {
        this.metas.text  = text;
        this.configs.pre_text = this.metas.text.trim();
        this.beforeSeach();
        this.ajax(() => {
           this.afterSearch();
        });
      }
    } else {
      this.configs.queue.push(text);
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
  defaultHtml: function() {
    jQuery('.block-content--main').html(this.metas.defaul_html);
  },
  setHtmlResult: function (res, callback) {
    const json = JSON.parse(res);
    let html = '';
    let remindHtml = '';
    if (this.configs.pre_text.trim().length == 0) {
      jQuery('.js-result-empty').hide();
      jQuery('.block-content--main').hide();
    } else if (json.suggestions.length > 0) {
      json.suggestions.map((row, idx) => {
        html += row.item_html;
      });
      jQuery('.block-content--main').html(html);
      jQuery('.js-result-empty').hide();

      jQuery('.block-content--main').show();
    } else {
      html = `No results`;
      jQuery('.block-content--main').hide();
      jQuery('.js-result-empty span').html(this.configs.pre_text);

      jQuery('.js-result-empty').show();
    }
   
  },
  afterSearch: function () {
    jQuery('.block-content--main').animate({
      opacity: 1
    }, 300, () => {
        this.configs.proccess_search = false;
        if (this.configs.queue.length > 0) {
          console.log('queuing ...');
          const text = this.configs.queue[this.configs.queue.length-1];
          this.configs.queue = [];
          this.search(text);
        }
    });
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