import WOW from '../../../../node_modules/wow.js/dist/wow';

export default {
  init() {
    // JavaScript to be fired on all pages


    jQuery(document).ready(function ($) {
      //function to check if the .cd-image-container is in the viewport here
      // ...

      //make the .cd-handle element draggable and modify .cd-resize-img width according to its position
      $('.cd-image-container').each(function () {
        var actual = $(this);
        drags(actual.find('.cd-handle'), actual.find('.cd-resize-img'), actual);
      });

      //function to upadate images label visibility here
      // ...
    });

    //testimonails slider
    $('.single-item').slick({
      autoplay: true,
      dots: true,
      infinite: true,
      arrows: false,
      responsive: [
        {
          breakpoint: 767,
          settings: {
            dots: false,
            arrows: true,
          },
        },
      ],
    });

    $('.profile-dropdown').on('mouseenter', function () {
      // make sure it is not shown:
      if (!$(this).parent().hasClass('show')) {
        $(this).parent().addClass('show');
      }
    });

    $('body').click(function () {
      if ($('.profile-dropdown').parent().hasClass('show')) {
        $('.profile-dropdown').parent().removeClass('show');
      }
    });

    $('li.dropdown a').click(function (e) {
      e.preventDefault();
      var $this = $(this);
      var href = $this.attr('href');
      
      if (href === 'undefined') {
        return false;
      } else {
        window.location.href = href;
      }
    });


    $('.product-grid').click(function () {
      $('.item-card').show(300);
      $('.item-card .bg-white').css('height', '300px');
      $('.item-card .bg-white').addClass('bg-images');

      $('.grid').masonry({
        itemSelector: '.grid-item',
      });
    });

    $('.product-list').click(function () {
      $('.item-card').show(300);
      $('.item-card .bg-white').css('height', 'auto');
      $('.item-card .bg-white').removeClass('bg-images');

      $('.grid').masonry({
        itemSelector: '.grid-item',
      });
    });

    $(window).scroll(function () {
      if ($(window).scrollTop() >= 65) {
        $('.fixed-top-header').addClass('fixed-header');
      }
      else {
        $('.fixed-top-header').removeClass('fixed-header');
      }
    });

    $(window).scroll(function () {
      if ($(window).scrollTop() >= 200) {
        $('.product-child').addClass('sticky');
      }
      else {
        $('.product-child').removeClass('sticky');
      }

      if ($(window).scrollTop() >= 2000) {
        $('.product-child').removeClass('sticky');
      }

    });

    $('.gallery-widgets').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 5,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });


    function drags(dragElement, resizeElement, container) {
      dragElement.on('mousedown vmousedown', function (e) {
        dragElement.addClass('draggable');
        resizeElement.addClass('resizable');

        var dragWidth = dragElement.outerWidth(),
          xPosition = dragElement.offset().left + dragWidth - e.pageX,
          containerOffset = container.offset().left,
          containerWidth = container.outerWidth(),
          minLeft = containerOffset + 10,
          maxLeft = containerOffset + containerWidth - dragWidth - 10;

        dragElement.parents().on('mousemove vmousemove', function (e) {
          var leftValue = e.pageX + xPosition - dragWidth;

          //constrain the draggable element to move inside its container
          if (leftValue < minLeft) {
            leftValue = minLeft;
          } else if (leftValue > maxLeft) {
            leftValue = maxLeft;
          }

          var widthValue = (leftValue + dragWidth / 2 - containerOffset) * 100 / containerWidth + '%';

          $('.draggable').css('left', widthValue).on('mouseup vmouseup', function () {
            $(this).removeClass('draggable');
            resizeElement.removeClass('resizable');
          });

          $('.resizable').css('width', widthValue);

          //function to upadate images label visibility here
          // ...

        }).on('mouseup vmouseup', function () {
          dragElement.removeClass('draggable');
          resizeElement.removeClass('resizable');
        });
        e.preventDefault();
      }).on('mouseup vmouseup', function () {
        dragElement.removeClass('draggable');
        resizeElement.removeClass('resizable');
      });
    }

    var wow = new WOW(
      {
        boxClass: 'wow',      // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0,          // distance to the element when triggering the animation (default is 0)
        mobile: true,       // trigger animations on mobile devices (default is true)
        live: true,       // act on asynchronously loaded content (default is true)
        callback: function () {
          // the callback is fired every time an animation is started
          // the argument that is passed in is the DOM node being animated
        },
        scrollContainer: null,    // optional scroll container selector, otherwise use window,
        resetAnimation: true,     // reset animation on end (default is true)
      }
    );
    wow.init();

    $('document').ready(function () {
      $('.tab-slider--body').hide();
      $('.tab-slider--body:first').show();
    });

    $('.tab-slider--nav li').click(function () {
      $('.tab-slider--body').hide();
      var activeTab = $(this).attr('rel');
      $('#' + activeTab).fadeIn();
      if ($(this).attr('rel') == 'tab2') {
        $('.tab-slider--tabs').addClass('slide');
      } else {
        $('.tab-slider--tabs').removeClass('slide');
      }
      $('.tab-slider--nav li').removeClass('active');
      $(this).addClass('active');
    });

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
