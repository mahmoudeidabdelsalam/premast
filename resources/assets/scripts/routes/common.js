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
