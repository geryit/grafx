import angular from 'angular';
import $ from 'jquery';
import 'slick-carousel';
import videojs from 'video.js';

$(document).ready(() => {
  if ($('.hSlider').length) {
    const $pBar = $('.slider__progress__inner');

    $('.hSlider').on('init', function () {
      const vidId = 0;

      // window.$pBarDots = $('.hSlider__dots');
      $(`#hSlider__video__${vidId}`).addClass('on').each(function () {
        const player = this;
        player.play();
      });
      $pBar.addClass('on');
      // $pBarDots.addClass('on');
      $(`#hSlider__body__${vidId}`).addClass('on');

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
      dotsClass: 'hSlider__dots',
    }).on('beforeChange', (event, slick, currentSlide, nextSlide) => {
      $(`#hSlider__poster__${nextSlide}`).addClass('on');

      $pBar.removeClass('on');

      setTimeout(() => {
        $(`#hSlider__poster__${nextSlide}`).removeClass('on');

        $(`#hSlider__body__${currentSlide}`).removeClass('on');
        $(`#hSlider__body__${nextSlide}`).addClass('on');

        $(`#hSlider__video__${currentSlide}`).removeClass('on').each(function () {
          this.pause();
          this.currentTime = 0;
        });
        $(`#hSlider__video__${nextSlide}`).addClass('on').each(function () {
          this.currentTime = 0;
          this.play();
        });
      }, 2000);
    }).on('afterChange', () => {
      $pBar.addClass('on');
    });
  }

  const $header = $('.header');
  const stickyNavTop = $header.offset().top;

  const stickyNav = () => {
    const scrollTop = $(window).scrollTop();

    if (scrollTop > stickyNavTop) {
      $header.addClass('sticky');
    } else {
      $header.removeClass('sticky');
    }
  };

  stickyNav();


  const sItem = $('.social');

  if (sItem.length) {
    const windowH = $(window).height();
    let windowS = 0;
    const sItemY = sItem.offset().top;

    window.isScrollOverSocialVideo = () => {
      windowS = $(document).scrollTop();
      if (windowH + windowS > sItemY + 100) {
        $('#social__video')[0].play();
        window.playSocialVideo = true;
      }
    };

    window.playSocialVideo = false;

    window.isScrollOverSocialVideo();
  }


  $(window).scroll(() => {
    stickyNav();
    if (!window.playSocialVideo && sItem.length) {
      window.isScrollOverSocialVideo();
    }
  });


  const stickyHeaders = ((() => {
    const $window = $(window);
    let $stickies;
    const mainHeaderHeight = $('.header').outerHeight();

    const load = (stickies) => {
      if (typeof stickies === 'object' && stickies.length > 0) {
        $stickies = stickies.each(function () {
          const $thisSticky = $(this).wrap('<div class="works__headWrap" />');

          $thisSticky
            .data('originalPosition', $thisSticky.offset().top)
            .data('originalHeight', $thisSticky.outerHeight())
            .parent()
            .height($thisSticky.outerHeight());
        });

        $window.off('scroll.stickies').on('scroll.stickies', () => {
          _whenScrolling();
        });
      }
    };

    let _whenScrolling = () => {
      $stickies.each(function (i) {
        const $thisSticky = $(this);
        const $stickyPosition = $thisSticky.data('originalPosition');

        if ($stickyPosition <= $window.scrollTop() + mainHeaderHeight) {
          const $nextSticky = $stickies.eq(i + 1);
          const $nextStickyPosition = $nextSticky.data('originalPosition') - $thisSticky.data('originalHeight');

          $thisSticky.addClass('fixed');
          $('.works--cats').addClass('pos-s');


          if ($nextSticky.length > 0 && $thisSticky.offset().top >= $nextStickyPosition) {
            $thisSticky.addClass('absolute').css('top', $nextStickyPosition);
            // console.log(1)
          }
        } else {
          const $prevSticky = $stickies.eq(i - 1);

          $thisSticky.removeClass('fixed');


          if ($prevSticky.length > 0 && $window.scrollTop() + mainHeaderHeight <= $thisSticky.data('originalPosition') - $thisSticky.data('originalHeight')) {
            $prevSticky.removeClass('absolute').removeAttr('style');
            // console.log(2)
          }
        }
      });
    };

    return {
      load,
    };
  }))();

  $('.menu').append('<div id="menuOverlay"><div/></div>');

  stickyHeaders.load($('.works__head'));

  $('.cSlider').slick({
    prevArrow: '<button class="cSlider__arrow cSlider__arrow__prev"></button>',
    nextArrow: '<button class="cSlider__arrow cSlider__arrow__next"></button>',
  });


  $('.video-js').each(function () {
    let myPlayer;
    let whereYouAt;
    let minutes;
    let seconds;
    let x;
    let y;
    if (this.id) {
      videojs(this.id).ready(function () {
        myPlayer = this;
        // myPlayer.play();

        myPlayer.on('timeupdate', () => {
          whereYouAt = myPlayer.currentTime();
          minutes = Math.floor(whereYouAt / 60);
          seconds = Math.floor(whereYouAt - minutes * 60);
          x = minutes < 10 ? `0${minutes}` : minutes;
          y = seconds < 10 ? `0${seconds}` : seconds;

          $('.vjs-remaining-time-display', myPlayer.el_).addClass('op1').html(`${x}:${y}`);
        });
      });
    }
  });

  if ($('body').hasClass('tax-work-category') || $('body').hasClass('search-results')) {
    $('.menu-item-object-work-category').addClass('current-menu-item');
  }
});


angular.module('grafxApp', [])
  .controller('grafxCtrl', ['$scope', ($scope) => {
    const scope = $scope;
    scope.vModal = {
      on: false,
      open(url, poster, index) {
        $('.hSlider').slick('slickPause');
        $(`#hSlider__video__${index}`).each(function () {
          this.pause();
        });
        $('.slider__progress__inner').removeClass('on');
        scope.vModal.on = true;

        // $("#vModal__video").attr("src", url);
        // $("#vModal__video").load();
        videojs('vModal__video').ready(function () {
          const vid = this;
          vid.src({type: 'video/mp4', src: url});
          vid.poster(poster);
          vid.load();
          vid.play();

          vid.on('timeupdate', () => { // chrome fix
            if (vid.currentTime() == vid.duration()) {
              scope.vModal.close();
            }
          });
        });
      },
      close(viaCloseBtn) {
        // because there is a timer, we need to use $apply
        if (viaCloseBtn) scope.vModal.on = false;
        else {
          scope.$evalAsync(() => {
            scope.vModal.on = false;
          });
        }
      },
    };

    scope.sModal = {
      on: false,
      open() {
        scope.sModal.on = true;
        setTimeout(() => {
          angular.element(document.getElementsByClassName('orig')).val('');
          angular.element(document.getElementsByClassName('orig')).focus();

          $('.asp_main_container').on('asp_search_end', (event, id, instance, phrase) => {
            if (!$('#seeAll').length) $('.results').append("<div id='seeAll'></div>");

            const html = `<div class='container'><a href='/?s=${phrase}&orderby=date&order=DESC' id='seeAll__link'>See all results for "${phrase}" </a></div>`;

            $('#seeAll').html(html);
          });
        }, 1000);
      },
      close() {
        scope.sModal.on = false;
      },
    };

    $('.searchBtn__btn').on('click', () => {
      scope.$evalAsync(() => {
        scope.sModal.open();
      });
    });

    // scope.sModal.open();

    // $http.get('/wp-json/wp/v2/work')
    //     .then(function(response){
    //         console.log(response)
    //     });

    scope.sections = [
      {
        title: 'BASIC INFORMATION',
        errorMsg: 'There were errors in your basic information.',
        fields: [
          {
            type: 'input',
            label: 'YOUR FIRST NAME',
            placeholder: 'Please Fill In',
          },
          {
            type: 'input',
            label: 'YOUR LAST NAME',
            placeholder: 'Please Fill In',
          },
          {
            type: 'email',
            label: 'E-MAIL',
            placeholder: 'Please Fill In',
          },
          {
            type: 'input',
            label: 'PHONE',
            placeholder: 'Please Fill In',
          },
        ],

      },
      {
        title: 'ADDRESS',
        errorMsg: 'There were errors in your basic information.',
        fields: [
          {
            type: 'input',
            label: 'YOUR FIRST NAME',
            placeholder: 'Please Fill In',
          },
          {
            type: 'input',
            label: 'YOUR LAST NAME',
            placeholder: 'Please Fill In',
          },
          {
            type: 'email',
            label: 'E-MAIL',
            placeholder: 'Please Fill In',
          },
          {
            type: 'input',
            label: 'PHONE',
            placeholder: 'Please Fill In',
          },
        ],

      }


    ];

    scope.submitApp = () => {
      if (scope.application__form.$valid) {
        console.log('true')
      } else {
        console.log('false')
      }

    }
  }]);
