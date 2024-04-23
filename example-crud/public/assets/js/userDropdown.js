$('#userSelect').change(function() {
    var userId = $(this).val();
    var currentUrl = window.location.href;
    var newUrl = updateQueryStringParameter(currentUrl, 'user', userId);
    window.location.href = newUrl;
});

function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    } else {
        return uri + separator + key + "=" + value;
    }
}
