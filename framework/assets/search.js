jQuery(document).ready(function ($) {

  var ajaxurl = sage.ajax_url;
  var width = 0;
  
  $('#autoblogs').autocomplete({
    minChars: 3,
    noCache: true,
    serviceUrl: ajaxurl,
    type: 'POST',
    containerClass: 'autocomplete-blog',
    dataType: 'json',
    paramName: 'name',
    params: {
      action: 'get_refineblog_names',
    },
    beforeRender: function (container, suggestions) {
      container.find('.autocomplete-blog').each(function (i, suggestion) {
        $(suggestion).wrapInner('<div class="search-resulte"><h3>' + suggestions[i].value + '</h3></div>');
        width = 100;
      });
    },
    onSearchStart: function () {
    },
  });
});