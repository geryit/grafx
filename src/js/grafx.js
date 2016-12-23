import angular from 'angular';
import $ from 'jquery';
import videojs from 'video.js';
import 'slick-carousel';
import 'angular-sanitize';
import 'ui-select';
import 'ng-file-upload';
import 'angular-recaptcha';
import countries from '../json/countries.json';
import states from '../json/states.json';
import sections from '../json/sections.json';

const templateUrl = theme_vars.templateUrl;


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

  if ($('.mModal').length) $('body').addClass('mModalOn');
});


angular.module('grafxApp', ['ui.select', 'ngSanitize', 'ngFileUpload', 'vcRecaptcha'])
  .controller('grafxCtrl', ['$scope', '$http', '$timeout', 'Upload',
    ($scope, $http, $timeout, Upload) => {
      const scope = $scope;
      const http = $http;
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
            vid.src({ type: 'video/mp4', src: url });
            vid.poster(poster);
            vid.load();
            vid.play();

            vid.on('timeupdate', () => { // chrome fix
              if (vid.currentTime() === vid.duration()) {
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

          $timeout(() => {
            angular.element(document.getElementsByClassName('orig')).val('');
            angular.element(document.getElementsByClassName('orig')).focus();
          }, 0);
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


      sections.forEach((v) => {
        v.fields.forEach((_m) => {
          const m = _m;
          if (m.name === 'country') {
            m.items = countries;
          } else if (m.name === 'state') {
            m.items = states;
          }
        });
      });

      scope.sections = sections;


      scope.uploadFiles = (_file, _errFiles, _section, _field) => {
        const errFile = _errFiles && _errFiles[0];
        const file = _file;
        const field = _field;
        const section = _section;

        // console.log(file, field, errFile, section);

        if (errFile) {
          field.placeholder = `File is bigger than ${errFile.$errorParam}`;
          section.invalid = field.invalid = true;
          field.value = '';
          field.value2 = '';
        } else if (file) {
          field.placeholder = 'Please Select a file';
          section.invalid = field.invalid = false;

          file.key = `resumes/${+new Date()}-${file.name}`;
          field.value = `http://d2hn5iac2prk31.cloudfront.net/${file.key}`;
          field.value2 = file.name;

          file.upload = Upload.upload({
            url: '//grafx.s3.amazonaws.com/', // S3 upload url including bucket name
            method: 'POST',
            data: {
              key: file.key, // the key to store the file on S3, could be file name or customized
              AWSAccessKeyId: 'AKIAI474FYZA6WDANSMQ',
              acl: 'public-read', // sets the access to the uploaded file in the bucket: private, public-read, ...
              success_action_redirect: '#',
              policy: 'ewogICAgImV4cGlyYXRpb24iOiAiMjAyMC0wMS0wMVQwMDowMDowMFoiLAogICAgImNvbmRpdGlvbnMiOiBbCiAgICAgICAgeyJidWNrZXQiOiAiZ3JhZngifSwKICAgICAgICBbInN0YXJ0cy13aXRoIiwgIiRrZXkiLCAicmVzdW1lcy8iXSwKICAgICAgICB7ImFjbCI6ICJwdWJsaWMtcmVhZCJ9LAogICAgICAgIHsic3VjY2Vzc19hY3Rpb25fcmVkaXJlY3QiOiAiIyJ9LAogICAgICAgIFsic3RhcnRzLXdpdGgiLCAiJENvbnRlbnQtVHlwZSIsICIiXSwKICAgICAgICBbInN0YXJ0cy13aXRoIiwgIiRmaWxlbmFtZSIsICIiXSwKICAgICAgICBbImNvbnRlbnQtbGVuZ3RoLXJhbmdlIiwgMCwgNTI0Mjg4MDAwXQogICAgXQp9', // base64-encoded json policy (see article below)
              signature: 'RfvIEns0trx3RkZGRyErHirdnKk=', // base64-encoded signature based on policy string (see article below)
              'Content-Type': file.type !== '' ? file.type : 'application/octet-stream', // content type of the file (NotEmpty)
              filename: file.name, // this is needed for Flash polyfill IE8-9
              file,
            },
          });
        }
      };


      scope.captcha = {
        key: '6LcuFA8UAAAAAGuYC0U655DOUoaJq3I_tatJ3exU',
        response: false,
        setResponse: (_response) => {
          scope.captcha.response = _response;
        },
      };

      const data = {};
      scope.submitApp = () => {
        angular.forEach(sections, (_section) => {
          const section = _section;


          section.invalid = false;
          angular.forEach(section.fields, (_field) => {
            const field = _field;
            if (field.type === 'input' || field.type === 'email' ||
              field.type === 'select' || field.type === 'file') {
              field.invalid = scope.application__form[field.name].$invalid;
              data[field.name] = field.value || '';
            } else if (field.type === 'checkbox') {
              let checkedItems = 0;
              field.value = '';
              field.items.forEach((item) => {
                if (item.checked) field.value += `${item.label} ,`;
                checkedItems += item.checked ? 1 : 0;
              });

              field.invalid = !field.notRequired && !checkedItems;
              data[field.name] = field.value || '';
            }

            if (field.invalid) {
              section.invalid = true;
            }
          });
        });


        // console.log(sections);


        data.g_recaptcha_response = scope.captcha.response;
        // console.log(data);

        const url = `${window.location.href}?appsent=1`;

        if (scope.application__form.$valid) {
          http.post(`${templateUrl}/sendmail.php`, data).then(
            (response) => {
              console.log(response);
              if (response.data === 'success') window.location.href = url;
            },
            () => {
              window.location.href = url;
            });
        } else {
          console.log('false');
        }


      };
    }]);
