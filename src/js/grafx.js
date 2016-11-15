$(document).ready(function () {

    if ($('.hSlider').length) {
        var $pBar = $('.slider__progress__inner');

        $('.hSlider').on('init', function () {
            window.$pBarDots = $('.hSlider__dots');
            window.$hsBody = $('.hSlider__body');
            $('.hSlider__video__0').each(function () {
                //this.play();
            });
            $pBar.addClass('on');
            $pBarDots.addClass('on');
            $hsBody.addClass('on');

            checkVideo(0);

        }).slick({
            draggable: true,
            adaptiveHeight: false,
            dots: true,
            mobileFirst: false,
            pauseOnDotsHover: false,
            pauseOnFocus: false,
            pauseOnHover: false,
            fade: true,
            autoplay: hsAutoplay,
            autoplaySpeed: hsAutoplaySecs * 1000,
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
            console.log('after', 'currentSlide:' + currentSlide, 'prevVidId:' + prevVidId)
            // $('.hSlider__video__' + prevVidId).each(function () {
            //     this.pause();
            //     this.currentTime = 0;
            // });
            //
            // $('.hSlider__video__' + currentSlide).each(function () {
            //     this.play();
            // });
            $pBar.addClass('on');
            $pBarDots.addClass('on');
            $hsBody.addClass('on');
            // $('#hSlider__video__' + currentSlide).on('canplaythrough', function () {
            //     this.play();
            // // })
            // var currentVid = $('.hSlider__video__' + currentSlide)[1];
            // currentVid.play();
            // console.log('after', currentSlide)
            checkVideo(currentSlide);


        });
    }

    var $header = $('.header');
    var stickyNavTop = $header.offset().top;

    var stickyNav = function () {
        var scrollTop = $(window).scrollTop();

        if (scrollTop > stickyNavTop) {
            $header.addClass('sticky');
        } else {
            $header.removeClass('sticky');
        }
    };

    stickyNav();

    $(window).scroll(function () {
        stickyNav();
    });


    function checkVideo(id) {
        $('.hSlider__last__'+id).addClass('on');
        // $('.hSlider__video__' + id).on('ended', function () {
        //     $(this).addClass('off');
        //     $('.hSlider__last__'+id).addClass('on');
        // });
    }
});


angular.module('grafxApp', [])
    .controller('grafxCtrl', ['$scope', function ($scope) {
        var scope = $scope;
        scope.vModal = {};

        scope.vModal.open = function (url, index) {
            $('.hSlider').slick('slickPause');
            $('.hSlider__video__' + index).each(function () {
                this.pause();
            });
            $('.slider__progress__inner').removeClass('on');
            scope.vModal.on = true;
            videojs("vModal__video").ready(function () {
                var myPlayer = this;
                myPlayer.src({"type": "video/mp4", "src": url});
                myPlayer.play();
            });
        };

        scope.vModal.close = function (url) {
            scope.vModal.on = false;
        }
    }]);
