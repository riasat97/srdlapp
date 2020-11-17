$(document).ready(function() {
    var s = $(".district-index-maps");
    var pos = s.position();                    
    $(window).scroll(function() {
       
       var activeId = $(".division-from-district.active").attr('id');
       if(activeId){
            var active_division = activeId.replace("-id", "");
            var division_id = '#'+active_division;    
            division_length = $(division_id+" > div > div").length

            if(division_length < 5){
                $(".district-index-maps").removeClass("stick");
            }else{
                var windowpos = $(window).scrollTop();
                if (windowpos >= 250) {
                    s.addClass("stick");
                    mainWidth = s.outerWidth();
                    $('.district-index-maps.stick svg').css({
                        width:mainWidth
                    });

                } else {
                    s.removeClass("stick"); 
                }
            }
       }else{
            var windowpos = $(window).scrollTop();
            if (windowpos >= 250) {
                s.addClass("stick");
                mainWidth = s.outerWidth();
                $('.district-index-maps.stick svg').css({
                    width:mainWidth
                });

            } else {
                s.removeClass("stick"); 
            }
       }
       

        
    });
});




matchHeightDiv();

function matchHeightDiv()
{
    $(function() {
        $('.news-match-height').matchHeight();
    });
}



(function ($) {
    'use strict';

    var finalEnlishToBanglaNumber={'0':'০','1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯'};

    String.prototype.getDigitBanglaFromEnglish = function() {
        var retStr = this;
        for (var x in finalEnlishToBanglaNumber) {
             retStr = retStr.replace(new RegExp(x, 'g'), finalEnlishToBanglaNumber[x]);
        }
        return retStr;
    };

    var browserWindow = $(window);

    // :: 1.0 Preloader Active Code
    browserWindow.on('load', function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    // :: 2.0 Countdown Active Code
    $('[data-countdown]').each(function () {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function (event) {

            // convert seconds
            var con_entobn=event.strftime('%S');
            var con_entobn=con_entobn.getDigitBanglaFromEnglish();

            // convert minutes
            var con_m_entobn=event.strftime('%M');
            var con_m_entobn=con_m_entobn.getDigitBanglaFromEnglish();

            // convert hours
            var con_h_entobn=event.strftime('%H');
            var con_h_entobn=con_h_entobn.getDigitBanglaFromEnglish();

            // convert days
            var con_d_entobn=event.strftime('%D');
            var con_d_entobn=con_d_entobn.getDigitBanglaFromEnglish();
            

            $this.html(event.strftime('<div>'+con_d_entobn+' <span>দিন</span></div> <div>'+con_h_entobn+' <span>ঘন্টা</span></div> <div>'+con_m_entobn+' <span>মিনিট</span></div> <div>'+con_entobn+' <span>সেকেন্ড</span></div>'));
        });
    });

    // :: 3.0 Nav Active Code
    if ($.fn.classyNav) {
        $('#cleverNav').classyNav();
    }

    // :: 4.0 Sliders Active Code
    if ($.fn.owlCarousel) {
        var candidatesSlide = $('.candidates-slide');
        candidatesSlide.owlCarousel({
            items: 3,
            margin: 0,
            loop: false,
            nav: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            dots: false,
            autoplay: false,
            autoplayTimeout: 6000,
            smartSpeed: 1500,
            center: false,
            transitionStyle : "fadeIn",
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 4
                }
            }
        });
    }

    // :: 5.0 Gallery Active Code
    if ($.fn.magnificPopup) {
        $('.video-btn').magnificPopup({
            type: 'iframe'
        });
    }

    // :: 6.0 ScrollUp Active Code
    if ($.fn.scrollUp) {
        browserWindow.scrollUp({
            scrollSpeed: 1500,
            scrollText: '<i class="fa fa-angle-up"></i>'
        });
    }

    function bdNumbers(x){
       
        x=x.toString();
        var lastThree = x.substring(x.length-3);
        var otherNumbers = x.substring(0,x.length-3);
        if(otherNumbers != '')
           lastThree = ',' + lastThree;
        return otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree
    }

    // :: 7.0 CouterUp Active Code
    if ($.fn.counterUp) {
        $('.counter').counterUp({
            delay: 10,
            time: 2000,
          
            formatter: function (n) {

var b = bdNumbers(n);

              var con_entobn = b.getDigitBanglaFromEnglish(); 
              return b.replace(b, con_entobn);

            }
        });
    }

    // :: 8.0 Sticky Active Code
    if ($.fn.sticky) {
        $(".clever-main-menu").sticky({
            topSpacing: 0
        });
    }

    // :: 9.0 wow Active Code
    if (browserWindow.width() > 767) {
        new WOW().init();
    }

    // :: 10.0 prevent default a click
    $('a[href="#"]').click(function ($) {
        $.preventDefault()
    });

})(jQuery);

$(document).delegate('#division_id','change',function () {

    var division_id = $(this).val();
    var get_district_id = $('#get_district_id').val();
    var url = $('#division_post_url').val();

    $.ajax({
        url: url,
        type: 'POST',
        data: {division_id:division_id,get_district_id:get_district_id},
        dataType: "json",
        success: function (data) {

            if(data.result == 'success'){

                $('#district').html(data.data);                

            }else{
                alert(data.message);
            }
        }
    });

    return false;
});


$('#division_id').trigger( "change" );

$(document).delegate('.division-link','click', function() {
    
    $('.single-catagories').show();

    var tabHref = $(this).attr('href');

    var data_division = tabHref.replace("#", "");

    $('.district_select').hide();
    
    $('#district_s_'+data_division).fadeIn();

});

$(document).delegate('.district_select','change', function() {

    var district_id = $(this).val();

    if(district_id){
        $('.single-catagories').hide();
        $('.seat-'+district_id).show();
    }else{
        $('.single-catagories').show();
    }
    

});