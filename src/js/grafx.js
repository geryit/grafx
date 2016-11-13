$(document).ready(function () {

    var $pBar =  $('.slider__progress__inner');

    $('.hSlider').on('init', function () {
        window.$pBarDots =  $('.hSlider__dots');
        window.$hsBody =  $('.hSlider__body');
        $('.hSlider__video__0').each(function () {
            this.play();
        });
        $pBar.addClass('on');
        $pBarDots.addClass('on');
        $hsBody.addClass('on');
    }).slick({
        draggable: true,
        adaptiveHeight: false,
        dots: true,
        mobileFirst: false,
        pauseOnDotsHover: false,
        pauseOnFocus: false,
        pauseOnHover: false,
        // fade: true,
        autoplay: true,
        autoplaySpeed: 4000,
        prevArrow: '<button class="hSlider__arrow hSlider__arrow__prev"></button>',
        nextArrow: '<button class="hSlider__arrow hSlider__arrow__next"></button>',
        dotsClass: 'hSlider__dots'
    }).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        console.log('before', 'currentSlide:' + currentSlide, 'nextSlide:' + nextSlide)
        $pBar.removeClass('on');
        $pBarDots.removeClass('on');
        $hsBody.removeClass('on');
        window.prevVidId = currentSlide;

    }).on('afterChange', function (event, slick, currentSlide) {
        console.log('after', 'currentSlide:' + currentSlide, 'prevVidId:'+prevVidId)
        $('.hSlider__video__' + prevVidId).each(function () {
            this.pause();
            this.currentTime = 0;
        });

        $('.hSlider__video__' + currentSlide).each(function () {
            this.play();
        });
        $pBar.addClass('on');
        $pBarDots.addClass('on');
        $hsBody.addClass('on');
        // $('#hSlider__video__' + currentSlide).on('canplaythrough', function () {
        //     this.play();
        // // })
        // var currentVid = $('.hSlider__video__' + currentSlide)[1];
        // currentVid.play();
        // console.log('after', currentSlide)


    });


});

angular.module('grafxApp', [])
    .controller('grafxCtrl', ['$scope', function ($scope) {
        // $scope.firstName = "sdf";
    }]);
