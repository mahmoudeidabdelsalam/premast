{{--
  Template Name: Limit Download
--}}

@extends('layouts.app-dark')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="limit-download" style="background-image:url({{ get_theme_file_uri().'/resources/assets/images/' }}limit-download.png);">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-12">
            <h2>{{ _e('Oops!', 'premast') }}</h2>
            <h3>{{ _e('You’ve reached your download limit for today.', 'premast') }}</h3>
            <small>{{ _e('Upgrade to on of our Premium Plans to keep downloading resources', 'premast') }}</small>
            <p style="display: flex; justify-content: space-between;"><a class="btn" href="{{ the_field('link_our_plan') }}">{{ _e('our plans', 'premast') }}</a> <a class="btn-referral" href="{{ the_field('link_page_referral', 'option')}}"><i class="fa fa-users" aria-hidden="true"></i> {{ _e('Or Invite a friend and get a Free month', 'premast') }}</a></p>
            <p class="text-limit">{{ _e('have questions? visit', 'premast') }} <a href="{{ the_field('link_page_faq') }}">{{ _e('FAQs', 'premast') }}</a></p>
          </div>
        </div>
      </div>
    </section>
  @endwhile
@endsection
