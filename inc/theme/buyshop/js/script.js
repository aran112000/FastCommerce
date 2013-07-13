$('body').on('click', '[data-rel*=lightbox]', function(e) {
    e.preventDefault();
    var $element = $(this);

    var fancybox_opts = {
        centerOnScroll: true,
        scrolling: 'yes'
    };

    var href_attr = $element.attr('href');
    if (typeof href_attr != 'undefined' && href_attr != '#') {
        fancybox_opts.href = href_attr;
    }

    var html_attr = $element.attr('data-lightbox-html');
    if (typeof html_attr != 'undefined' && html_attr.length > 0) {
        fancybox_opts.content = html_attr;
    }
    $element.fancybox(fancybox_opts);
});