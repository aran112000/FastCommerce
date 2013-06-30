var __af = __ajaxify();

$('body').on('click', '[data-ajaxify-handler]', function() {
    var data={};

    var allow_multiple = (typeof $(this).attr('allow-multiple') != 'undefined');

    var handler = $(this).attr('data-ajaxify-handler');
    if (typeof handler !== 'undefined' && handler.length > 0) {
        var handler_parts = handler.split(':');
        data.act = handler_parts[0];
        data.handler = handler_parts[1];

        if (!allow_multiple) {
            $(this).removeAttr('data-ajaxify-handler');
        }
    }

    var payload = $(this).attr('data-ajaxify-data');
    if (typeof payload !== 'undefined' && payload.length > 0) {
        data.payload = $.parseJSON(payload);

        if (!allow_multiple) {
            $(this).removeAttr('data-ajaxify-data');
        }
    }

    data.payload.act = data.act;
    data.payload.handler = data.handler;

    var elm_id = $(this).attr('id');
    if (typeof elm_id != 'undefined') {
        data.payload.origin = '#' + elm_id;
    }

    __af.send(data);

    return false;
});

function __ajaxify() {
    return {
        send: function (data, callback)  {
            if (typeof data.payload == 'object') {
                $.ajax({
                    url: '/',
                    global: false,
                    type: 'GET',
                    dataType: 'JSON',
                    data: data.payload,
                    success: function(response) {
                        if (typeof response.update != 'undefined') {
                            __af.update(response.update);
                        }
                        if (typeof response.prepend != 'undefined') {
                            __af.prepend(response.prepend);
                        }
                        if (typeof response.append != 'undefined') {
                            __af.append(response.append);
                        }
                        if (typeof response.script != 'undefined') {
                            __af.inject_script(response.script);
                        }

                        if (typeof callback == 'function') {
                            callback();
                        } else {
                            console.log(typeof callback);
                        }
                    }
                });
            } else {
                console.error('Please supply valid data to Ajaxify');
            }
        },
        update: function(elements) {
            for (var selector in elements) {
                $(selector).html(elements[selector]);
            }
        },
        prepend: function(elements) {
            for (var selector in elements) {
                $(selector).prepend(elements[selector]);
            }
        },
        append: function(elements) {
            for (var selector in elements) {
                $(selector).append(elements[selector]);
            }
        },
        inject_script: function(elements) {
            var $body = $('body');
            for (var selector in elements) {
                $body.append('<script class="af">' + elements[selector] + '</script>');
            }
        }
    }
}