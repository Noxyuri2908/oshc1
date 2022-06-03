function creatSlug(_str, _element) {
    var url_ =  $("#url_hostname").val() + "create-slug";
    $.get(url_, { str: _str, }, function (data) {
          _element.val(data.slug);
    });
}

$("#name").on('change', function() {
    creatSlug($(this).val(), $("#slug"));
});