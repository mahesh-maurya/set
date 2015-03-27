/*Mobile Menu Js*/

var slider;
var slider2;

//$(document).ready(function () {
$(window).load(function () {
    $('.menuOverlay').hide();
    $('#push, #close').click(function () {
        var $navigacia = $('body, #slide-menu'),
            val = $navigacia.css('left') === '250px' ? '0px' : '250px';
        $navigacia.animate({
            left: val
        }, 300)
        $('.menuOverlay').toggle();
    });
});


/*clients page tab js*/
//$(document).ready(function(){
$(window).load(function () {
    $('.clientTabUl li a').click(function () {
        var filterLinkName = $(this).attr('data-element');
        $('.commonTab').css('display', 'none');
        $("." + filterLinkName).css('display', 'block');
        $('.activeTab').removeClass('activeTab');
        $(this).addClass('activeTab')
    });
});


/*borad of director*/
//$(document).ready(function() {
$(window).load(function () {
    var contact = $('.contactUsMainDiv').outerHeight();
    var allimchand = parseInt($('.allimchand').outerHeight());
    $('.allimchand').css('top', (contact - allimchand - 70) / 2);
});


/*borad of director*/
/* $(document).ready(function() { */
$(window).load(function () {
    $('.textHover').fadeOut();
    $('.sectorUl li').hover(function () {
        $(this).children('.hoverDiv').animate({
            'bottom': '0px'
        });
        $(this).children('.hoverDiv').children('.textHover').fadeIn(1000);
    }, function () {
        $(this).children('.hoverDiv').animate({
            'bottom': '-53px'
        });
        $(this).children('.hoverDiv').children('.textHover').fadeOut(1000);
    });
});


/*project page slider*/
//$(document).ready(function() {
$(window).load(function () {
    var sliderlength = $('.pro-bxslider').children("li").length;
    slider = $('.pro-bxslider').show().bxSlider({
        minSlides: 1,
        maxSlides: 3,
        infiniteLoop: false,
        slideWidth: 1024,
        onSliderLoad: function () {
            var totalcount = slider.getSlideCount();
            if (totalcount == 1) {
                $(".bx-next").hide();
                $(".bx-prev").hide();
            } else {

                $(".bx-prev").hide();
            }
        },
        onSlideAfter: function (slider, oldnum, newnum) {
            $(".bx-prev").show();
            $(".bx-next").show();
            if (newnum == 0) {
                $(".bx-prev").hide();
            }
            if (newnum == (sliderlength - 1)) {
                $(".bx-next").hide();
            }

        }

    });



});


/*second project page slider*/
//$(document).ready(function() {
$(window).load(function () {
    var slider2length = $('.pro-bxslider').children("li").length;
    slider2 = $('.Scndpro-bxslider').show().bxSlider({
        minSlides: 1,
        maxSlides: 3,
        infiniteLoop: false,
        slideWidth: 500,
        onSliderLoad: function () {
            var totalcount = slider2.getSlideCount();
            if (totalcount == 1) {
                $(".bx-next").hide();
                $(".bx-prev").hide();
            } else {

                $(".bx-prev").hide();
            }
        },
        onSlideAfter: function (slider, oldnum, newnum) {
            $(".bx-prev").show();
            $(".bx-next").show();
            if (newnum == 0) {
                $(".bx-prev").hide();
            }
            if (newnum == (slider2length - 1)) {
                $(".bx-next").hide();
            }

        }
    });
});



/*index page jquery*/
$(window).load(function () {
    setTimeout(function () {
        $('.galleryImg').hover(function () {
            $(this).children('.sectorOverlay').show();
        }, function () {
            $(this).children('.sectorOverlay').hide();
        });

    }, 1000);
});





/*Banner js*/
/*
$(document).ready(function(e) {
$('.bxslider').bxSlider({
mode: 'fade',
captions: true,
auto: true,															
});

});

$(document).ready(function(){
// declare global
var slider_array = new Array();
jQuery(document).ready(function($){    
// launch bxslider
$('.pro-bxslider').each(function(i){
slider_array[i] = $(this).bxSlider({controls:false});
}); 
// bind controls on custom controls, and run functions on every slider
$('.bxslider-controls a').bind('click', function(e) {
e.preventDefault();

if($(this).hasClass('pull-left')) {
$.each(slider_array, function(i,elem){
elem.goToPrevSlide();  
});    
} else if($(this).hasClass('pull-right')) {
$.each(slider_array, function(i,elem){
elem.goToNextSlide();  
});
}    
});    
});
});*/