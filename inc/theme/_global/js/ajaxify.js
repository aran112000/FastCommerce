var __af = __ajaxify();

$('body').on('click', 'a[data-ajaxify-handler]', function() {
    var data={};

    var handler = $(this).attr('data-ajaxify-handler');
    if (typeof handler !== 'undefined' && handler.length > 0) {
        var handler_parts = handler.split(':');
        data.act = handler_parts[0];
        data.handler = handler_parts[1];
    }

    var payload = $(this).attr('data-ajaxify-data');
    if (typeof payload !== 'undefined' && payload.length > 0) {
        data.payload = $.parseJSON(payload);
    }

    data.payload.act = data.act;
    data.payload.handler = data.handler;

    __af.send(data);
});

function __ajaxify() {
    return {
        send: function (data)  {
            if (typeof data.payload == 'object') {
                $.ajax({
                    url: '/',
                    global: false,
                    type: 'GET',
                    dataType: 'JSON',
                    data: data.payload,
                    success: function(response) {
                        alert('success: ' + response);
                    }
                });
            } else {
                console.error('Please supply valid data to Ajaxify');
            }
        }
    }
}