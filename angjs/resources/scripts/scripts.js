function jumpTo(section)
{
    var target = $('#' + section).offset().top;
    console.log(target);

    if (target == 332) {
        offset = 168; // Zaradi slider-a
    } else {
        offset = 84;
    }
    $("body, html")
        .animate({
            scrollTop: $('#' + section).offset().top - offset
        }, 600);
}

// Scroll
$(window).bind('scroll', function () {
    if ($(window).scrollTop() > 50) {
        $('#header').css({
                      "transition": "background-color 0.5s ease",
                      "background-color": "#434343",
                      "position": "fixed",
                      "color": "#FFF",
                      "z-index": "20000"
                    });
    } else {
        $('#header').css({
                      "transition": "background-color 0.5s ease",
                      "background-color": "#f0eee3",
                      "position": "relative",
                      "color": "#434343",
                      "z-index": "20000"
                    });
    }
});
