@if (
    !function_exists('elementor_theme_do_location') ||
        !elementor_theme_do_location('footer'))
    <footer class="text-start text-lg-start pmst-footer container-fluid">
        <div class="container-fluid p-5 pb-0">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="logo">
                        <a href="{{ home_url('/') }}">
                            <img style="width: 100px; height: auto;"
                                src="@asset('images/logo-premast-footer.svg')" alt="Premast logo"
                                class="img-fluid">
                        </a>
                    </div>
                    <p class="pmst-footer-text mt-3">
                        Make it easy for everyone to present his idea with great
                        design
                    </p>
                    {{-- Social icons --}}
                    <div class="social-icons">
                        @if (have_rows('social_networks', 'option'))
                            <ul class="list-inline text-left m-0 social-btns">
                                @while (have_rows('social_networks', 'option'))
                                    @php the_row(); @endphp
                                    <li class="list-inline-item"><a
                                            class="network"
                                            href="{{ the_sub_field('network_link', 'option') }}"><i
                                                class="fa {{ the_sub_field('network_icon', 'option') }}"></i></a>
                                    </li>
                                @endwhile
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col">

                    {{-- links grid --}}
                    <div class="row">
                        <div
                            class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 navbar-footer">
                            @if (has_nav_menu('footer_navigation'))
                                {!! wp_nav_menu([
                                    'theme_location' => 'footer_navigation',
                                    'container' => false,
                                    'menu_class' => 'navbar',
                                    'walker' => new NavWalker(),
                                ]) !!}
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </footer>




    <style>
        .pmst-footer * {
            /* outline: 1px solid red;
         background: rgba(255, 0, 0, 0.1); */
            font-family: Poppins, sans-serif;
        }

        .pmst-footer .navbar-footer .navbar {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: flex-start;
            align-content: flex-start;
            align-self: flex-start;
            width: 100%;
            flex: 1 1 auto;
            min-width: 200px;
        }

        .pmst-footer .navbar-footer .navbar .menu-item-has-children {
            flex: 1 1 auto;
            min-width: 200px;
        }



        .pmst-footer {
            background-color: #161528;
            padding: 50px 0;
        }

        .pmst-footer-text {
            color: #C1C4D6;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 400;
            font-family: Poppins, sans-serif;
        }

        .pmst-footer .social-icons {
            margin-top: 20px;
        }

        .pmst-footer .social-icons .network {
            color: #C1C4D6;
            font-size: 20px;
            margin-right: 10px;
        }
    </style>

@endif
