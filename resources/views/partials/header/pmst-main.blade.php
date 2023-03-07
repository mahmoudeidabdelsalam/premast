@if (
    !function_exists('elementor_theme_do_location') ||
        !elementor_theme_do_location('header'))
    <div class="container-xxl">
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">
                    <a href="{{ home_url('/') }}">
                        <img src="{{ get_field('website_logo', 'option') }}"
                            alt="premast logo" class="img-fluid logo"
                            width="100">
                    </a>
                </span>
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if (has_nav_menu('primary_navigation'))
                        {!! wp_nav_menu([
                            'theme_location' => 'primary_navigation',
                            'container' => false,
                            'menu_class' => 'navbar-nav ms-auto pmst-nav',
                            'walker' => new NavWalker(),
                        ]) !!}
                    @endif
                </div>
                {{-- Login buttons --}}
                <div class="d-flex align-items-center gap-2 pmst-login">
                    <a href="https://app.premast.com/login"
                        class="btn btn-outline-secondary mx-1" target="_blank">
                        {{-- icon --}}
                        <i class="fa fa-user me-2"></i>
                        Sign in</a>
                    <a href="https://app.premast.com/login"
                        class="btn btn-primary mx-1"
                        target="_blank
                ">Try for free</a>
                </div>
            </div>
        </nav>
    </div>

    <style>
        .btn-outline-secondary {
            color: #696F8C;
            border-color: #D8DAE5;
        }

        .btn-outline-secondary:hover {
            color: #696F8C !important;
            background-color: #D8DAE5 !important;
            border-color: #D8DAE5 !important;
        }

        .btn-outline-secondary:focus {
            box-shadow: unset !important;

        }

        .pmst-nav {
            display: flex;
            align-items: center;
        }

        .pmst-nav .nav-link {
            color: #000;
            font-size: 15px;
            font-weight: 400;
            padding: 0 10px;
        }

        .pmst-login .fa {
            font-size: 12px;
            font-weight: 400;
        }
    </style>
@endif
