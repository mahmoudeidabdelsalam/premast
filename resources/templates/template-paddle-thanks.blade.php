{{--
  Template Name: Paddle Thanks Template
--}}

@php 
  $send = (isset($_POST['alert_name']))? $_POST['alert_name']:'';
  $passthrough = (isset($_POST['passthrough']))? $_POST['passthrough']:'';
  $subscription_plan_id = (isset($_POST['subscription_plan_id']))? $_POST['subscription_plan_id']:'';
  
  $subscription_id = (isset($_POST['subscription_id']))? $_POST['subscription_id']:'';

  $status = (isset($_POST['status']))? $_POST['status']:'';
  if ($status == 'active') {
    $wcm_status == 'wcm-active';
  } elseif($status == 'past_due') {
    $wcm_status == 'wcm-pending';
  } elseif($status == 'deleted') {
    $wcm_status == 'wcm-cancelled';
  }

  $cancel_url = (isset($_POST['cancel_url']))? $_POST['cancel_url']:'';
  $update_url = (isset($_POST['update_url']))? $_POST['update_url']:'';

  global $current_user;
  wp_get_current_user();

  $subscription_plan_paddle_one   = get_field('subscription_plan_paddle_one', 'option');
  $subscription_plan_paddle_two   = get_field('subscription_plan_paddle_two', 'option');
  $subscription_plan_paddle_three = get_field('subscription_plan_paddle_three', 'option');

  $member_ship_plan_one   = get_field('member_ship_plan_one', 'option');
  $member_ship_plan_two   = get_field('member_ship_plan_two', 'option');
  $member_ship_plan_three = get_field('member_ship_plan_three', 'option');
@endphp

@if ($send)
  @php 

    if($cancel_url) {
      update_user_meta( $passthrough, 'cancel_url', $cancel_url );
    }
    if ($update_url){
      update_user_meta( $passthrough, 'update_url', $update_url );
    }

    if ($subscription_plan_id == $subscription_plan_paddle_one) {
      $plan_id = $member_ship_plan_one;
    } elseif ($subscription_plan_id == $subscription_plan_paddle_two) {
      $plan_id = $member_ship_plan_two;
    } elseif ($subscription_plan_id == $subscription_plan_paddle_three) {
      $plan_id = $member_ship_plan_three;
    }


    if ($send == 'subscription_created') {

      $event_time = (isset($_POST['event_time']))? $_POST['event_time']:'';
      $next_bill_date = (isset($_POST['next_bill_date']))? $_POST['next_bill_date']:'';

      $data = apply_filters( 'wc_memberships_groups_import_membership_data', array(
        'plan_id' => $plan_id, 
        'post_parent' => $plan_id,
        'post_author'    => $passthrough,
        'post_type'      => 'wc_user_membership',
        'post_status'    => 'wcm-active',
      ) );


      $user_membership_id = wp_insert_post( $data, true );
      update_post_meta($user_membership_id, '_start_date', $event_time);
      update_post_meta($user_membership_id, '_end_date', $next_bill_date);
      update_post_meta($user_membership_id, 'subscription_id', $subscription_id);


    } elseif ($send == 'subscription_updated') {

      $next_bill_date = (isset($_POST['next_bill_date']))? $_POST['next_bill_date']:'';


      $updated = array(
        'post_type' => 'wc_user_membership',
        'suppress_filters' => 0,
        'numberposts'   => 1,
        'meta_key' => 'subscription_id',
        'meta_value' => $subscription_id,
        'author' => $passthrough
      );
      $updateds = get_posts($updated);

      if($updateds) {
        foreach ($updateds as  $post) {
          wp_update_post(array(
            'ID'          =>  $post->ID,
            'post_type'   => 'wc_user_membership',
            'post_status' =>  $wcm_status,
          ));
          update_post_meta($post->ID, '_end_date', $next_bill_date);
          do_action('wp_update_post', 'wp_update_post');
        }
      }

    } elseif ($send == 'subscription_cancelled') {

      $next_bill_date = (isset($_POST['cancellation_effective_date']))? $_POST['cancellation_effective_date']:'';

      $updated = array(
        'post_type' => 'wc_user_membership',
        'numberposts'   => 1,
        'meta_key' => 'subscription_id',
        'meta_value' => $subscription_id,
        'author' => $passthrough
      );
      $updateds = get_posts($updated);

      if($updateds) {
        foreach ($updateds as  $post) {
          wp_update_post(array(
            'plan_id' => $plan_id, 
            'post_parent' => $plan_id,
            'ID'          =>  $post->ID,
            'post_type'   => 'wc_user_membership',
            'post_status' =>  'wcm-cancelled',
          ));
          update_post_meta($post->ID, '_end_date', $next_bill_date);
          do_action('wp_update_post', 'wp_update_post');
        }
      }

    } elseif ($send == 'subscription_payment_succeeded') {

      $next_bill_date = (isset($_POST['next_bill_date']))? $_POST['next_bill_date']:'';

      $updated = array(
        'post_type' => 'wc_user_membership',
        'numberposts'   => 1,
        'meta_key' => 'subscription_id',
        'meta_value' => $subscription_id,
        'author' => $passthrough
      );
      $updateds = get_posts($updated);

      if($updateds) {
        foreach ($updateds as  $post) {
          wp_update_post(array(
            'ID'          =>  $post->ID,
            'post_type'   => 'wc_user_membership',
            'post_status' =>  'wcm-active',
          ));
          update_post_meta($post->ID, '_end_date', $next_bill_date);
          do_action('wp_update_post', 'wp_update_post');
        }
      }

    } elseif ($send == 'subscription_payment_failed') {

      $next_bill_date = (isset($_POST['next_bill_date']))? $_POST['next_bill_date']:'';

      $updated = array(
        'post_type' => 'wc_user_membership',
        'numberposts'   => 1,
        'meta_key' => 'subscription_id',
        'meta_value' => $subscription_id,
        'author' => $passthrough
      );
      $updateds = get_posts($updated);

      if($updateds) {
        foreach ($updateds as  $post) {
          wp_update_post(array(
            'plan_id' => $plan_id, 
            'post_parent' => $plan_id,
            'ID'          =>  $post->ID,
            'post_type'   => 'wc_user_membership',
            'post_status' =>  'wcm-pending',
          ));
          update_post_meta($post->ID, '_end_date', $next_bill_date);
          do_action('wp_update_post', 'wp_update_post');
        }
      }

    }


    $user_subscription_id = get_post_meta( $passthrough, 'subscription_id', true )

    dd($subscription_id, $user_subscription_id);
  @endphp
@endif  

@extends('layouts.app-dark')

@section('content')

  <!-- Modal -->
  <div class="modal" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" >
      <div class="modal-content" style="background-image: linear-gradient(150deg, {{ the_field('gradient_color_one','option') }} 0%, {{ the_field('gradient_color_two','option') }} 100%);">
        <div class="elementor-background-overlay" style="background-image: url('{{ the_field('banner_background_overlay','option') }}');"></div>
        <div class="modal-header border-0">
          <h5 class="modal-title text-white" id="exampleModalLongTitle">Dear <?= $current_user->display_name; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-white">
          <h2 class="text-white">Thank you,</h2> For your subscription 
        </div>
      </div>
    </div>
  </div>
  <script>
    jQuery(function($) {
      $('#exampleModalLong').modal('show')
    });
  </script>

  <div class="checkout-custom-header">
    <h1>{{ _e('Thanks for your subscription!', 'premast') }}</h1>
    @php ($like_download = get_field('download_page','option') . '?tabs=paid')
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
