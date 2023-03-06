



@php
  $refine   = isset($_GET['refine']) ? $_GET['refine'] : '0';
  $sort   = isset($_GET['sort']) ? $_GET['sort'] : '0';
  $taxonomy_query = get_queried_object();
  global $current_user;
  wp_get_current_user();
  global $wp;
  $logout = esc_html(wp_logout_url('https://premast.com/templates/'));
@endphp
<pmst-main-header></pmst-main-header>


<script>
let data = {!! json_encode(pmst_get_header_data()) !!};
let logout = {!! json_encode($logout, JSON_UNESCAPED_UNICODE) !!};
logout = logout.replace(/&amp;/g, '&');
  // get header element
  let header = document.querySelector('pmst-header');
  // set attributes
  header.logo = data.logo;
  header.userIsLogin = data.user_login
  header.user = {
                name: data.user_name,
                avatar: data.user_avatar,
                premium: data.premium
            }
  header.navList = data.nav;
  header.userMenu = data.user_menu;
  header.upgradeLink = data.upgrade_link
  // listen to logout click 
  header.addEventListener('logout', function(e) {
    window.location.href = logout;
  });
  header.addEventListener('signin', function(e) {
    login(e)
  });
  header.addEventListener('signup', function(e) {
    signup(e)
  });
  header.addEventListener('google-signin', function(e){
    console.log('Google')
    let googleLink = document.createElement('a');
    let currentUrl = window.location.href;
    googleLink.href = `https://premast.com/wp/wp-login.php?loginSocial=google&redirect=${currentUrl}`;
    console.log(googleLink)
    // click on the link
    googleLink.click();
  });
  header.addEventListener('search' , function(e){
    let search = e.detail
    console.log(search)
    window.location.href = `https://premast.com/items/?refine=${search}`

  }
  );

  function login(e){
    console.log(e.detail);
    // login user using AJAX
    jQuery.ajax({
      url: "<?php echo admin_url('admin-ajax.php'); ?>",
      type: 'POST',
      data: {
        action: 'pmst_login',
        email: e.detail.email,
        password: e.detail.password
      },
      beforeSend: function () {
        header.loading = true;
      },
      
      success: function(response) {
        json = JSON.parse(response);
        console.log(json);
        if (json.success) {
          header.signinSuccess();
          header.showSignin = false;
          window.location.reload();
        } else {
          header.signinError(json.message);
        }
      },
      error: function(errorThrown) {
        header.signinError('there is an error on website')
        console.log(errorThrown);
      }

    });
  }

  function signup(e){
    console.log('signup')
    jQuery.ajax({
      url: "<?php echo admin_url('admin-ajax.php'); ?>",
      type: 'POST',
      data: {
        action: 'pmst_signup',
        email: e.detail.email,
        password: e.detail.password,
        name: e.detail.name
      },
      beforeSend: function () {
        header.loading = true;
      },
      
      success: function(response) {
        json = JSON.parse(response);
        console.log(json);
        console.log(header)
        if (json.success) {
          header.signinSuccess();
          header.showSignup = false;
          window.location.reload();
        } else {
          header.signinError(json.message);
        }
      },
      error: function(errorThrown) {
        header.signinError('there is an error on website')
        console.log(errorThrown);
      }

    });


  }

  // make header sticky at the top of the page 
  let y = header.getBoundingClientRect().top + window.scrollY;

  header.style.cssText = `
  position: sticky; 
  top: ${y}px; 
  z-index: 9999;`;

</script>
