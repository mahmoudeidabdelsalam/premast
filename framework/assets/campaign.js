jQuery(function ($) {

  // eslint-disable-next-line no-undef
  var ajaxurl = sage.ajax_url;

  var rev = $('.rev_slider');
  rev.on('init', function (event, slick, currentSlide) {
    var
      cur = $(slick.$slides[slick.currentSlide]),
      next = cur.next(),
      prev = cur.prev();
    prev.addClass('slick-sprev');
    next.addClass('slick-snext');
    cur.removeClass('slick-snext').removeClass('slick-sprev');
    slick.$prev = prev;
    slick.$next = next;
  }).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    console.log('beforeChange');
    var
      cur = $(slick.$slides[nextSlide]);
    console.log(slick.$prev, slick.$next);
    slick.$prev.removeClass('slick-sprev');
    slick.$next.removeClass('slick-snext');
    next = cur.next(),
      prev = cur.prev();
    prev.prev();
    prev.next();
    prev.addClass('slick-sprev');
    next.addClass('slick-snext');
    slick.$prev = prev;
    slick.$next = next;
    cur.removeClass('slick-next').removeClass('slick-sprev');
  });

  rev.slick({
    speed: 600,
    arrows: false,
    dots: true,
    focusOnSelect: true,
    infinite: true,
    centerMode: true,
    slidesPerRow: 1,
    slidesToShow: 1,
    slidesToScroll: 1,
    centerPadding: '0',
    swipe: true,
    customPaging: function (slider, i) {
      return '';
    },
  });



  // $('.galleryPro').lightGallery({
  //   thumbnail: true,
  //   animateThumb: false,
  //   showThumbByDefault: false,
  // });

  $('.paginations li').on('click', function () {
    $('.paginations li').removeClass('acitve');
    $(this).addClass('acitve');
    var page = $(this).data('page');
    var term = $(this).data('term');
    var page_id = $(this).data('page-id');
    var action = 'front_end_campaign';
    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        action: action,
        page: page,
        term: term,
        page_id: page_id,
      },
      beforeSend: function () {
        $('.loading').show();
      },
      success: function (response) {
        $('#ajax-' + term).html(response);
        $('.loading').hide();
      },
    });
  });

});