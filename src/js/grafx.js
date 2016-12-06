jQuery(document).ready(function ($) {

    if ($('.hSlider').length) {
        var $pBar = $('.slider__progress__inner');

        $('.hSlider').on('init', function () {

            var vidId = 0;

            // window.$pBarDots = $('.hSlider__dots');
            $('#hSlider__video__' + vidId).addClass('on').each(function () {
                var player = this;
                player.play();
            });
            $pBar.addClass('on');
            // $pBarDots.addClass('on');
            $('#hSlider__body__' + vidId).addClass('on');

            // checkVideo(vidId);

            $(this).append('<div class="pluses pluses--float"><div class="container"><div class="pluses__inner"></div></div></div>');

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

    if (sItem.length) {
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
    }


    $(window).scroll(function () {
        stickyNav();

        if (!window.playSocialVideo && sItem.length) {
            isScrollOverSocialVideo();
        }


    });


    var stickyHeaders = (function () {

        var $window = $(window),
            $stickies;
        var mainHeaderHeight = $('.header').outerHeight();

        var load = function (stickies) {
            if (typeof stickies === "object" && stickies.length > 0) {

                $stickies = stickies.each(function () {

                    var $thisSticky = $(this).wrap('<div class="works__headWrap" />');

                    $thisSticky
                        .data('originalPosition', $thisSticky.offset().top)
                        .data('originalHeight', $thisSticky.outerHeight())
                        .parent()
                        .height($thisSticky.outerHeight());
                });

                $window.off("scroll.stickies").on("scroll.stickies", function () {
                    _whenScrolling();
                });
            }
        };

        var _whenScrolling = function () {

            $stickies.each(function (i) {

                var $thisSticky = $(this),
                    $stickyPosition = $thisSticky.data('originalPosition');

                if ($stickyPosition <= $window.scrollTop() + mainHeaderHeight) {

                    var $nextSticky = $stickies.eq(i + 1),
                        $nextStickyPosition = $nextSticky.data('originalPosition') - $thisSticky.data('originalHeight');

                    $thisSticky.addClass("fixed");
                    $('.works--cats').addClass('pos-s');


                    if ($nextSticky.length > 0 && $thisSticky.offset().top >= $nextStickyPosition) {

                        $thisSticky.addClass("absolute").css("top", $nextStickyPosition);
                        // console.log(1)

                    }

                } else {

                    var $prevSticky = $stickies.eq(i - 1);

                    $thisSticky.removeClass("fixed");


                    if ($prevSticky.length > 0 && $window.scrollTop() + mainHeaderHeight <= $thisSticky.data('originalPosition') - $thisSticky.data('originalHeight')) {

                        $prevSticky.removeClass("absolute").removeAttr("style");
                        // console.log(2)

                    }
                }
            });
        };

        return {
            load: load
        };
    })();

    $('.menu').append('<div id="menuOverlay"><div/></div>');

    stickyHeaders.load($(".works__head"));

    $(".cSlider").slick({
        prevArrow: '<button class="cSlider__arrow cSlider__arrow__prev"></button>',
        nextArrow: '<button class="cSlider__arrow cSlider__arrow__next"></button>',
    });


    $('.video-js').each(function () {
        var myPlayer, whereYouAt, minutes, seconds, x, y;
        if (this.id) videojs(this.id).ready(function () {
            myPlayer = this;

            // myPlayer.play();

            myPlayer.on("timeupdate", function () {
                whereYouAt = myPlayer.currentTime();
                minutes = Math.floor(whereYouAt / 60);
                seconds = Math.floor(whereYouAt - minutes * 60);
                x = minutes < 10 ? "0" + minutes : minutes;
                y = seconds < 10 ? "0" + seconds : seconds;

                $(".vjs-remaining-time-display", myPlayer.el_).addClass('op1').html(x + ":" + y);
            })


        });
    });

    if ($("body").hasClass("tax-work-category") || $("body").hasClass("search-results")) {
        $(".menu-item-object-work-category").addClass('current-menu-item');
    }


});


angular.module('grafxApp', [])
    .controller('grafxCtrl', ['$scope', function ($scope) {
        var scope = $scope;
        scope.vModal = {
            on: false,
            open: function (url, poster, index) {
                $('.hSlider').slick('slickPause');
                $('#hSlider__video__' + index).each(function () {
                    this.pause();
                });
                $('.slider__progress__inner').removeClass('on');
                scope.vModal.on = true;

                // $("#vModal__video").attr("src", url);
                // $("#vModal__video").load();
                videojs("vModal__video").ready(function () {
                    var vid = this;
                    vid.src({"type": "video/mp4", "src": url});
                    vid.poster(poster);
                    vid.load();
                    vid.play();

                    vid.on("timeupdate", function () { //chrome fix
                        if (vid.currentTime() == vid.duration()) {
                            scope.vModal.close();

                        }
                    });
                });

            },
            close: function (viaCloseBtn) {
                //because there is a timer, we need to use $apply
                if (viaCloseBtn) scope.vModal.on = false;
                else scope.$evalAsync(function () {
                    scope.vModal.on = false;
                });

            }
        };

        scope.sModal = {
            on: false,
            open: function () {
                scope.sModal.on = true;
                setTimeout(function () {
                    angular.element(document.getElementsByClassName("orig")).val('');
                    angular.element(document.getElementsByClassName("orig")).focus();

                    $(".asp_main_container").on("asp_search_end", function (event, id, instance, phrase) {

                        if (!$('#seeAll').length) $(".results").append("<div id='seeAll'></div>");

                        var html = "<div class='container'>" +
                            "<a href='/?s=" + phrase + "&orderby=date&order=DESC' id='seeAll__link'>See all results for \"" + phrase + "\" </a></div>";

                        $("#seeAll").html(html);
                    });
                }, 1000);
            },
            close: function () {
                scope.sModal.on = false;
            }
        };

        $('.searchBtn__btn').on("click", function () {
            scope.$evalAsync(function () {
                scope.sModal.open();

            });

        });

        // scope.sModal.open();

        // $http.get('/wp-json/wp/v2/work')
        //     .then(function(response){
        //         console.log(response)
        //     });
    }]);
