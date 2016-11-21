$(document).ready(function () {

    if ($('.hSlider').length) {
        var $pBar = $('.slider__progress__inner');

        $('.hSlider').on('init', function () {

            var vidId = 0;

            // window.$pBarDots = $('.hSlider__dots');
            $('#hSlider__video__' + vidId).addClass('on').each(function () {
                this.play();
            });
            $pBar.addClass('on');
            // $pBarDots.addClass('on');
            $('#hSlider__body__' + vidId).addClass('on');

            // checkVideo(vidId);

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

            $('#hSlider__poster__' + nextSlide).addClass('on');

            $pBar.removeClass('on');

            setTimeout(function () {
                $('#hSlider__poster__' + nextSlide).removeClass('on');

                $('#hSlider__body__' + currentSlide).removeClass('on');
                $('#hSlider__body__' + nextSlide).addClass('on');

                $('#hSlider__video__' + currentSlide).removeClass('on').each(function () {
                    this.pause();
                    this.currentTime = 0;
                });
                $('#hSlider__video__' + nextSlide).addClass('on').each(function () {
                    this.currentTime = 0;
                    this.play();
                });

            }, 2000);

        }).on('afterChange', function (event, slick, currentSlide) {
            $pBar.addClass('on');
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

    var sItem = $('.social');
    var windowH = $(window).height();
    var windowS = 0;
    var sItemY = sItem.offset().top;

    var isScrollOverSocialVideo = function () {
        windowS = $(this).scrollTop();
        if (windowH + windowS > sItemY + 100) {
            $('#social__video')[0].play();
            window.playSocialVideo = true;
        }
    };

    window.playSocialVideo = false;

    isScrollOverSocialVideo();
    $(window).scroll(function () {
        stickyNav();

        if (!window.playSocialVideo) {
            isScrollOverSocialVideo();
        }
    });

    $('.menu').append('<div id="menuOverlay"/>');

});


angular.module('grafxApp', [])
    .controller('grafxCtrl', ['$scope', function ($scope) {
        var scope = $scope;
        scope.vModal = {};

        scope.vModal.open = function (url, poster, index) {
            $('.hSlider').slick('slickPause');
            $('#hSlider__video__' + index).each(function () {
                this.pause();
            });
            $('.slider__progress__inner').removeClass('on');
            scope.vModal.on = true;
            videojs("vModal__video").ready(function () {
                var vid = this;
                vid.src({"type": "video/mp4", "src": url});
                vid.poster(poster);
                vid.play();
            });
        };

        scope.vModal.close = function () {
            scope.vModal.on = false;
        }
    }]);
