var lazyload = lazyload || {};

(function($, lazyload) {

    "use strict";

    var page = 2,
        buttonId = "#button-more",
        loadingId = "#loading-div",
        container = "#more-news";

    lazyload.load = function() {
        load_data();        
    };

    var appendContests = function(response) {
        var id = $(buttonId);

        $(buttonId).show();
        $(loadingId).hide();

        $(response).appendTo($(container));
        page += 1;
    };

    function load_data()
    {
        
        var url = $('#load_more_news').val();
        var changeValue = '15';
        var start = $('#start').val();
        var district_tag = $('#hidden_district_tag').val();

        $(buttonId).hide();
        $(loadingId).show();

        $.ajax({
            url: url,
            data: { start : start,district_tag:district_tag },
            //cache: true,
            success: function(response) {
                if (response.length < 10) {
                   
                    // $(buttonId).fadeOut();
                    // $(loadingId).text("No more entries to load!");
                    $('#button-more').hide();
                    $('#loading-div').hide();
                    return;
                }

                var calculateStart = Number(start) + 15;
                var htmlString = $( "*" ).html();
                //localStorage.removeItem('palo-dynamic');
               // localStorage.setItem('palo-dynamic', response);

                $('#start').val(calculateStart);
                appendContests(response);




                // var htmlString = $( "*" ).html();
                // caches.open('my-site-cache-v1')
                // .then(function(cache) {
                // console.log('Opened cache 2');
                // return cache.addAll([
                //     './',
                //   ]);
                // })

            },
            error: function(response) {
                $(loadingId).text("Sorry, there was some error with the request. Please refresh the page.");
            }
        });
    }

    // $( window ).scroll(function() {
    //     load_data();
    // });

})(jQuery, lazyload);
