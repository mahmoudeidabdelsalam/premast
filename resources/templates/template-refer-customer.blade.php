{{--
  Template Name: User Customer Refer
--}}

@extends('layouts.app-dark')

@section('content')

@if(!is_user_logged_in())
  <div class="container">
    <div class="row justify-content-center m-0">
      <div class="user-not-login">
        <h2>{{ _e('Join us and enjoy with this benefits', 'premast') }}</h2>
        <p>{{ _e('Join Premast today.', 'premast') }}</p>
        <a class="mt-2 login btn btn-blue" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a>
      </div>
    </div>
  </div>
@else

  <section class="template-users">
    <div class="container-fiuld woocommerce customer-download">
      <div class="row">
        <div class="col-md-3 col-12 side-menu-user">
          <h2 class="headline text-primary">{{ _e('My Account', 'premast') }}</h2>
          @if (has_nav_menu('user_navigation'))
            {!! wp_nav_menu(['theme_location' => 'user_navigation', 'container' => false, 'menu_class' => 'nav nav-pills flex-column flex-sm-row col-12', 'walker' => new NavWalker()]) !!}
          @endif
        </div>
        <div class="col-md-7 col-12 pt-5 mt-5">
          <div class="row align-content-center justify-content-center">
            <div class="col-md-7 col-12">
              <h3>{{ _e('Share the Experience, Invite friends', 'premast') }}</h3>
              <h4 class="headline-linear">{{ _e('& Earn free monthly subscriptions', 'premast') }}</h4>
            </div>
            <div class="col-md-5 col-12 the-content">@php the_content() @endphp</div>
          </div>
          <div class="row ml-0 mr-0 mt-5 mb-5 align-content-center justify-content-center">
            <div class="col-12 p-0">
              <div class="custom-share">
                <h4>{{ _e('Invite through mail', 'premast') }}</h4>
                <form class="form-inline">
                  <div class="form-group mb-2">
                    <label for="inputPassword2" class="sr-only">write an email</label>
                    <input type="email" class="form-control" id="emailInput" placeholder="write an email">
                  </div>
                  <button type="submit" class="btn btn-primary mb-2 shadow-none py-2 px-4">{{ _e('Send Invite', 'premast') }}</button>
                </form>
                @php 
                  global $current_user;
                  wp_get_current_user();

                  $link = get_field('link_signup', 'option').'?refer='.$current_user->ID.'&token='.get_the_date('U').'';
                @endphp
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
            <div class="col-12 p-0 mt-4">
              <a href="#" class="text-primary">{{ _e('Know more about referral system', 'permast') }} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
          </div>


          @php 
            $args = array(
              'post_type' => 'wc_user_membership',
              'post_status'   => array('wcm-active', 'wcm-expired', 'wcm-pending'),
              'suppress_filters' => 0,
              'numberposts'   => -1,
              'author' => $current_user->ID
            );
            $posts = get_posts($args);
            $end_date = date('Y-m-d H:i:s', strtotime('+1 months'));
            $start_date = date('Y-m-d H:i:s');
          @endphp

          <h4>{{ _e('Check your progress', 'premast') }}</h4>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">date</th>
                <th scope="col">Referrals <i class="fa fa-question-circle-o" aria-hidden="true" data-toggle="tooltip" title="name a friend from Invitation"></i></th>
                <th scope="col">Rewards <i class="fa fa-question-circle-o" aria-hidden="true" data-toggle="tooltip" title="status of Invitation with acion"></i></th>
                <th scope="col">Expires on <i class="fa fa-question-circle-o" aria-hidden="true" data-toggle="tooltip" title="Date Invitation completed"></i></th>
              </tr>
            </thead>
            <tbody>
            <?php
              foreach ($posts as $post):
              setup_postdata( $post ); 
              $author = get_user_by( 'ID', $post->post_author );
              $author_display_name = $author->display_name;
              $date_stamp = strtotime($post->post_date);
              $postdate = date("M d, Y", $date_stamp);
              $expired = date('M d, Y', strtotime(get_post_meta( $post->ID, '_end_date', true )));
              $ex_active = date('M d, Y', strtotime($post->post_date. ' + 7 days'));
              $status = get_post_status($post->ID, 'post_status', TRUE);
              if($status == 'wcm-active'):
                $label = '<span class="text-green"> <i class="fa fa-check" aria-hidden="true"></i> Activated</span>';
              elseif($status == 'wcm-pending'):
                $label = '<a data-id="'.$post->ID.'" href="javascript:void(0)" class="activate-now text-blue" >Activate Now</a>';
              elseif($status == 'wcm-expired'):
                $label = '<span class="text-red">expired</span>';
              else: 
                $label = '-';
              endif;
            ?>
              <tr>
                <td><?= $postdate; ?></td>
                <td><?= (get_post_meta($post->ID, 'email_referrals', TRUE))? get_post_meta($post->ID, 'email_referrals', TRUE):'-'; ?></td>
                <td class="rewards" id="<?= $post->ID; ?>"><?= $label; ?></td>
                <td><?= ($status == 'wcm-pending')? $ex_active:$expired; ?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>


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

            $('.activate-now').on('click', function () {
              var active_id = $(this).data('id');
              var status = $('td#' + active_id);
              
              $.ajax({
                url:"<?= admin_url( 'admin-ajax.php' ); ?>",       
                type:'POST',
                data: {
                  action: 'get_active',
                  post_id: active_id,
                },
                success: function (data) {
                  status.html('<span class="text-green"> <i class="fa fa-check" aria-hidden="true"></i> Activated</span>');
                },
              });
            });
          });
        </script>

      </div>
    </div>
  </section>


  <style>
    table.table {
      background: #FFFFFF;
      border: 1px solid #E3E3E3;
      box-sizing: border-box;
      box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
      border-radius: 8px !important;
      overflow: hidden;
      margin: 30px 0;
      border-collapse: initial !important;
    }

    .table thead th {
      border: none !important;
      font-weight: bold;
      font-size: 14px;
      line-height: 21px;
      letter-spacing: 0.04px;
      text-transform: capitalize;
      color: #3F4A59;
      padding-bottom: 20px !important;
    }

    table.table tbody tr:first-child td {
      border: none !important;
    }

    .table td.first {
      font-weight: bold;
      font-size: 14px;
      line-height: 21px;
      letter-spacing: 0.04px;
      color: #646464;
    }

    .table td {
      font-weight: 500;
      font-size: 14px;
      line-height: 21px;
      letter-spacing: 0.04px;
      color: #282F39;
    }
    .table thead th i {
      font-size: 14px;
      line-height: 16px;
      color: #A6A6A6;
      cursor: help;
    }
    .the-content {
    font-size: 16px;
    line-height: 24px;
    letter-spacing: 0.04px;
    color: #000000;
}
  </style>
@endif
@endsection
