$(document).ready(function() {
    //Auto complete off
    $("input.autocomplete-off").attr("autocomplete", "off");
    //Refresh captcha image
    $(".change-captcha").click(function() {
        var rnd = new Date().getTime();
        var src = $("img.captcha-img").attr("src");
        if (src.indexOf("?") != -1) {
            var ind = src.indexOf("?");
            src = src.substr(0, ind);
        }
        src += "?" + rnd;
        $("img.captcha-img").attr("src", src);
        $("#verify").val("");
    });
});
