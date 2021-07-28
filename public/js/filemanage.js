
function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}


function settingIframe(id_a, id_thumb, id_preview) {
    $(id_a).fancybox({
        'width': 900,
        'height': 900,
        'type': 'iframe',
        'autoScale': false,
        'autoSize': false,
        afterClose: function () {
            var thumb = $(id_thumb).val();
            if (thumb) {
                var html = '<div class="img_preview" style="margin-bottom: 20px; width:100%"><img style="width:100%" src="' + thumb + '"/></div>';
                $(id_preview).html(html);
            }
        },
        helpers: {
            overlay: {
                locked: false
            }
        }
    });
}

function settingIframeArr(id_a, id_thumb, id_preview) {
    $(id_a).fancybox({
        'width': 900,
        'height': 900,
        'type': 'iframe',
        'autoScale': false,
        'autoSize': false,
        afterClose: function () {
            var thumb;
            if(IsJsonString($(id_thumb).val())){
                thumb = JSON.parse($(id_thumb).val());
            }else{
                thumb = $(id_thumb).val();
            }

            if (thumb) {
                var html = '';
                if($.isArray(thumb)){
                    thumb.map(function(data){
                        html += '<div class="img_preview" style="margin-bottom: 20px; width:100%"><img src="' + data + '"/></div>';
                    })
                }else{
                    html += '<div class="img_preview" style="margin-bottom: 20px; width:100%"><img src="' + thumb + '"/></div>';
                }
                $(id_preview).html(html);
            }
        },
        helpers: {
            overlay: {
                locked: false
            }
        }
    });
}
