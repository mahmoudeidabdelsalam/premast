{{--
  Template Name: Thanks Customer
--}}

@extends('layouts.app-dark')

@section('content')


  @php 
    $send = (isset($_GET['send']))? $_GET['send']:'';
    global $current_user;
    wp_get_current_user();
  @endphp

  @if($send == 'true')
    <!-- Modal -->
    <div class="modal" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content" style="background-image:url('{{ the_field('background_banner_hero') }}');">
          <div class="modal-header border-0">
            <h5 class="modal-title text-white" id="exampleModalLongTitle">Dear <?= $current_user->display_name; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-white">
            <h2 class="text-white">Thank you,</h2> the invitation has been sent to your friend
          </div>
        </div>
      </div>
    </div>
    <script>
      jQuery(function($) {
        $('#exampleModalLong').modal('show')
      });
    </script>
  @endif

    <div class="checkout-custom-header">
      <h1>{{ _e('Thanks for your purchase!', 'premast') }}</h1>
      <p>We hope you like your experience with premast, check your downloads in profile to download the item you just purchased</p>
      @php ($like_download = get_field('download_page','option') . '?tabs=paid')
      <div class="bottom-summary pr-4 pl-4">
        <a href="{{ $like_download }}">{{ _e("Go to your downloads now", 'premast') }}</a>
      </div>
    </div>


  <section class="banner-share">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-md-6 text-left">
          <h3>Psssst! Wanna get a month of premium subscription for free?</h3>
          <p class="text-left">Have up to 6 months free premium subscription by inviting your friends to sign up at Premast. For each friend you bring you will have a 1 month free premium subscription.</p>
        </div>
        <div class="col-12 col-md-6">
          <div class="custom-share">
            <h4>{{ _e('Invite through mail', 'premast') }}</h4>
            <?php
              $form = get_field('forms_referral', 'option');
              $inputs = get_all_form_fields($form['id']);
              $link = get_field('link_signup', 'option').'?refer='.$current_user->ID.'&token='.get_the_date('U').'';
            ?>

            <form class="form-inline" role="" method="post" id="gform_<?= $form['id']; ?>" action="<?= the_permalink(); ?>?send='true'">
              <?php foreach ($inputs as $input): ?>
                <?php if($input["type"] == "email"): ?>
                  <div class="form-group mb-2">
                    <input type="email" name="input_<?= $input["id"]; ?>" class="form-control" id="emailInput" placeholder="write an email">
                  </div>
                <?php elseif($input["type"] == "hidden"): ?>
                  <input type="text" name="input_<?= $input["id"]; ?>" class="form-control" hidden value="<?= $current_user->display_name; ?>">
                <?php else: ?>
                  <input type="text" name="input_<?= $input["id"]; ?>" class="form-control" hidden value="<?= $link; ?>">
                <?php endif; ?>
              <?php endforeach; ?>
              <button id="gform_submit_button_<?= $form['id']; ?>" class="btn btn-primary mb-2 shadow-none py-2 px-4"><span>{{ _e('Send Invite', 'premast') }}</span></button>
              <input type="hidden" class="gform_hidden" name="is_submit_<?= $form['id']; ?>" value="1">
              <input type="hidden" class="gform_hidden" name="gform_submit" value="<?= $form['id']; ?>">
              <input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
              <input type="hidden" class="gform_hidden" name="state_<?= $form['id']; ?>" value="WyJbXSIsImU5YjY1MWMyNzBhYjc5MDI0ZjlmYzlkZjVhMzVmMTZmIl0=">
              <input type="hidden" class="gform_hidden" name="gform_target_page_number_<?= $form['id']; ?>" id="gform_target_page_number_<?= $form['id']; ?>" value="0">
              <input type="hidden" class="gform_hidden" name="gform_source_page_number_<?= $form['id']; ?>" id="gform_source_page_number_<?= $form['id']; ?>" value="1">
              <input type="hidden" name="gform_field_values" value="">
            </form>

            <ul class="list-inline social-sharer">
              <li class="head"><span>{{ _e('Share your link', 'premast') }}</span></li>
              <li class="list-inline-item">
                <a class="item" data-network="linkedin" data-url="{{ home_url('/') }}" data-title="{{ $link}}" href="#"> <i class="fa fa-linkedin"></i></a>
              </li>
              <li class="list-inline-item">
                <a class="item" data-network="twitter"  data-url="{{ home_url('/') }}" data-title="{{ $link}}" href="#"> <i class="fa fa-twitter"></i></a>      
              </li>
              <li class="list-inline-item">
                <a class="item" data-network="facebook" data-url="{{ home_url('/') }}" data-title="{{ $link}}" href="#"> <i class="fa fa-facebook"></i></a>      
              </li>
              <li class="list-inline-item">
                <a class="item" data-network="addtoany" data-url="{{ $link }}" data-title="{{ $link }}" href="#"> <i class="fa fa-ellipsis-v"></i></a>      
              </li>
            </ul>

            <div id="inviteCode" class="invite-page">
              <input id="link" value="{{ $link }}" readonly>
              <div id="copy">
                <i data-copytarget="#link">{{ _e('Copy Link', 'premast') }}</i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<script>
  jQuery(function($) {
    
    $('#copy').on('click', function(event) {
      console.log(event);
      copyToClipboard(event);
    });
    
    function copyToClipboard(e) {
      var
        t = e.target, 
        c = t.dataset.copytarget,
        inp = (c ? document.querySelector(c) : null);
      console.log(inp);
      if (inp && inp.select) {
        inp.select();
        try {
          document.execCommand('copy');
          inp.blur();
          t.classList.add('copied');
          setTimeout(function() {
            t.classList.remove('copied');
          }, 1500);
        } catch (err) {
          alert('please press Ctrl/Cmd+C to copy');
        }
      }
    }
  });
</script>

@endsection


<style>
.checkout-custom-header {
    margin-top: 50px;
    height: 300px;
    position: relative;
    background: linear-gradient(176.82deg, #1FA2FF -4.21%, #274FDB 135.73%);
    display: flex;
    justify-content: center;
    align-items: center;
    flex-flow: column;
}

.checkout-custom-header h1 {
    font-style: normal;
    font-weight: 500;
    font-size: 40px;
    line-height: 47px;
    text-align: center;
    letter-spacing: 0.04px;
    text-transform: capitalize;
    color: #FFFFFF;
}

.checkout-custom-header p {
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 24px;
    text-align: center;
    letter-spacing: 0.04px;
    color: #FFFFFF;
    width: 50%;
}

.checkout-custom-header .bottom-summary {
    box-shadow: none !important;
}
</style>