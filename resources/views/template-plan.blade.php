{{--
  Template Name: Plan Template
--}}

@extends('layouts.dark-app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="banner" style="background-image:url('{{ the_field('background_plan_banner') }}');">
      <div class="container">
        <div class="row align-items-center text-center justify-content-center">
          <div class="col-md-7 col-sm-12 col-12">
            <h2>{{ the_field('headline_plan_page') }}</h2>
            <p>{{ the_field('instructions_plan_page') }}</p>
            <p class="time-back"><span>{{ the_field('time_money_back') }}</span> {{ _e('money back guarantee', 'premast') }}</p>
          </div>
        </div>
      </div>
    </section>

    <section class="pricing-table" style="background-image:url('{{ the_field('background_plan_table') }}');">
      <div class="container">
        <div class="row align-items-center text-center justify-content-center">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="box-pricing">
              <div class="headline-pricing">
                {{ _e('Basic', 'premast') }}
              </div>
              <div class="box-in-pricing">
                <div class="head-box-pricing">
                  <span class="number-pricing">
                    {{ _e('FREE', 'premast') }}
                  </span>
                  <span class="free-pricing">
                    {{ _e('all you need is to create an account, no need to subscribe!', 'premast') }}
                  </span>
                </div>
                <div class="list-items">
                  <span>{{ _e('Access for all  free items.', 'premast') }}</span>
                  <span>{{ _e('5 downloads/day', 'premast') }}</span>
                  <span>{{ _e('40 downloads/month', 'premast') }}</span>
                  <span>{{ _e('attribution of premast.com', 'premast') }}</span>
                  <span>{{ _e('Personal license Only', 'premast') }}</span>
                </div>
                <div class="choose plan">
                  <a class="mt-2 signup btn-primary" href="#" data-toggle="modal" data-target="#SignupUser">{{ _e('Sign Up', 'premast') }}</a>
                </div>
              </div>
            </div>
          </div>
          @if( have_rows('plan_pricing_box') )
            @while ( have_rows('plan_pricing_box') ) @php the_row() @endphp
              <div class="col-md-3 col-sm-6 col-12">
                <div class="box-pricing">
                  <div class="headline-pricing">
                    {{ the_sub_field('headline_plan_box') }}
                  </div>
                  <div class="box-in-pricing">
                    <div class="head-box-pricing">
                      <span class="date-access">
                        {{ the_sub_field('date_access') }}
                      </span>
                      <span class="number-pricing">
                        {{ the_sub_field('pricing_number') }}$
                      </span>
                      <span class="date-pricing">
                        {{ the_sub_field('pricing_date') }}
                      </span>
                    </div>
                    <div class="list-items">
                      @if( have_rows('list_plan') )
                        @while ( have_rows('list_plan') ) @php the_row() @endphp
                          <span>{{ the_sub_field('list_item') }}</span>
                        @endwhile
                      @endif
                    </div>
                    @php 
                    $product_id = get_sub_field('choose_plan');  
                    @endphp

                      <div class="choose plan">
                        {!! do_shortcode( '[ajax_add_to_cart id="'.$product_id.'" text="choose plan" style="" show_price="false" /]' ) !!}
                      </div>
                     
                  </div>
                </div>
              </div>
            @endwhile
          @endif

          <div class="col-12 mt-5 mb-5">
            <img src="{{ the_field('image_checkout') }}" alt="{{ the_title() }}">
          </div>
        </div>
      </div>
    </section>
  @endwhile
@endsection


