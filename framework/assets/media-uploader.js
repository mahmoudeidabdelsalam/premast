(function ($) {
  // When the DOM is ready.
  $(function () {
    var thumbnail_upload; // variable for the wp.media file_frame

    // attach a click event (or whatever you want) to some element on your page
    $('#frontend-button').on('click', function (event) {
      event.preventDefault();
      if (thumbnail_upload) {
        thumbnail_upload.open();
        return;
      }
      thumbnail_upload = wp.media.frames.thumbnail_upload = wp.media({
        title: $(this).data('uploader_title'),
        button: {
          text: $(this).data('uploader_button_text'),
        },
        multiple: false // set this to true for multiple file selection
      });
      thumbnail_upload.on('select', function () {
        attachment = thumbnail_upload.state().get('selection').first().toJSON();
        $('#thumbnails').attr('value', attachment.id);
        $('.profile-pic').attr('src', attachment.url);
      });

      thumbnail_upload.open();
    });







    var gallery_upload; // variable for the wp.media file_frame
    
    $('#frontend-gallery').on('click', function (event) {
      event.preventDefault();
      if (gallery_upload) {
        gallery_upload.open();
        return;
      }

      gallery_upload = wp.media.frames.gallery_upload = wp.media({
        title: $(this).data('uploader_title'),
        button: {
          text: $(this).data('uploader_button_text'),
        },
        multiple: true // set this to true for multiple file selection
      });

      gallery_upload.on('select', function () {
        attachments = gallery_upload.state().get('selection').toJSON();

        var i;
        var ids = '';
        var images = '';

        for (i = 0; i < attachments.length; ++i) {
          ids += attachments[i].id + ',';
          images += '<img class="thumb" src="' + attachments[i].url + '" >';
        }

        //sample function 1: add image preview
        $('#thumb-output').html(images);
        $('#gallers').attr('value', ids);

      });

      gallery_upload.open();
    });




    var file_upload; // variable for the wp.media file_frame

    // attach a click event (or whatever you want) to some element on your page
    $('#upload_file').on('click', function (event) {
      event.preventDefault();
      if (file_upload) {
        file_upload.open();
        return;
      }
      file_upload = wp.media.frames.file_upload = wp.media({
        title: $(this).data('uploader_title'),
        button: {
          text: $(this).data('uploader_button_text'),
        },
        multiple: false // set this to true for multiple file selection
      });
      file_upload.on('select', function () {
        attachment = file_upload.state().get('selection').first().toJSON();
        
        $('#files_url').attr('value', attachment.url);
        $('#files_name').attr('value', attachment.filename);
        $('.name-files').html(attachment.filename);
      });

      file_upload.open();
    });

  });

})(jQuery);