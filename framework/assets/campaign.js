jQuery(function ($) {

  // eslint-disable-next-line no-undef
  var ajaxurl = sage.ajax_url;

  $('#lightSlider').lightSlider({
    item: 3,
    loop: true,
    auto: true,
    slideMove: 1,
    easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
    speed: 600,
    mode: 'fade',
    responsive: [
      {
        breakpoint: 800,
        settings: {
          item: 2,
          slideMove: 1,
          slideMargin: 6,
        },
      },
      {
        breakpoint: 480,
        settings: {
          item: 1,
          slideMove: 1,
        },
      },
    ],
  });

  
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

  $('.ajaxModal').on('click', function () {
    var post_id = $(this).data('id');
    var action = 'get_front_end_gallery';
    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        action: action,
        post_id: post_id,
      },
      beforeSend: function () {
        $('.loading').show();
      },
      success: function (response) {
        $('#ModalAjax').html(response);
        $('.loading').hide();
        $('#galleryPro' + post_id).lightSlider({
          gallery: true,
          item: 1,
          loop: true,
          thumbItem: 6,
          slideMargin: 0,
          enableDrag: false,
          currentPagerPosition: 'left',
          onSliderLoad: function (el) {
            $('.lightSlider').removeClass('cS-hidden');
            el.lightGallery({
              selector: '#imageGallery .lslide',
            });
          },
          responsive: [{
            breakpoint: 480,
            settings: {
              enableDrag: true,
              controls: false,
              thumbItem: 4,
            },
          }],
        });
      },
    });
  });

});